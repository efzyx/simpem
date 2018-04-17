<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePengadaanRequest;
use App\Http\Requests\UpdatePengadaanRequest;
use App\Repositories\PengadaanRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use App\Models\BahanBakuHistory;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\BahanBaku;
use Response;
use Auth;
use App\Models\pemesanan_bahan_baku;

class PengadaanController extends AppBaseController
{
    /** @var  PengadaanRepository */
    private $pengadaanRepository;

    public function __construct(PengadaanRepository $pengadaanRepo)
    {
        $this->pengadaanRepository = $pengadaanRepo;
        $this->bahanBakus = BahanBaku::pluck('nama_bahan_baku', 'id');
        $this->pemesanan_bahan_bakus = pemesanan_bahan_baku::pluck('nama_supplier', 'id');
        $this->middleware('role:admin,manager_produksi,logistik')->only('index', 'show');
        $this->middleware('role:logistik')->except('index', 'show');
    }

    /**
     * Display a listing of the Pengadaan.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pengadaanRepository->pushCriteria(new RequestCriteria($request));
        $pengadaans = $this->pengadaanRepository->paginate(10);
        $title = "Penerimaan Bahan Baku";

        return view('pengadaans.index')
            ->with('pengadaans', $pengadaans)
            ->with('title', $title)
            ->with('supplier', $this->pemesanan_bahan_bakus);
    }

    /**
     * Show the form for creating a new Pengadaan.
     *
     * @return Response
     */
    public function create()
    {
        $title = "Penerimaan Bahan Baku - Tambah";
        return view('pengadaans.create')
            ->with('bahanBakus', $this->bahanBakus)
            ->with('title', $title)
            ->with('supplier', $this->pemesanan_bahan_bakus);
    }

    /**
     * Store a newly created Pengadaan in storage.
     *
     * @param CreatePengadaanRequest $request
     *
     * @return Response
     */
    public function store(CreatePengadaanRequest $request)
    {
        $input = $request->all();
        $supplier = pemesanan_bahan_baku::find($input['supplier']);
        $input['bahan_baku_id'] = $supplier->bahan_baku_id;
        $bahan_baku=BahanBaku::find($input['bahan_baku_id']);
        if ($bahan_baku->batas_pengadaan) {
            if ($input['berat'] > $maks = $bahan_baku->batas_pengadaan->maks_pengadaan) {
                Flash::error('Maksimal kuantitas pengadaan '.$bahan_baku->nama_bahan_baku.' adalah '. $maks.' '.$bahan_baku->satuan);
                return redirect()->back()->withInput($input);
            }
        }


        $input['user_id'] = Auth::user()->id;

        $pengadaan = $this->pengadaanRepository->create($input);

        $bahan_baku = BahanBaku::find($pengadaan->bahan_baku_id);
        $bahan_baku->sisa = $bahan_baku->sisa + $pengadaan->berat;
        $bahan_baku->save();

        $history = new BahanBakuHistory();
        $history->bahan_baku_id = $pengadaan->bahan_baku_id;
        $history->type = 2;
        $history->volume = $pengadaan->berat;
        $history->pengadaan_id = $pengadaan->id;
        $history->total_sisa = $bahan_baku->sisa;
        $history->save();


        Flash::success('Penerimaan Bahan Baku saved successfully.');

        return redirect(route('pengadaans.index'));
    }

    /**
     * Display the specified Pengadaan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pengadaan = $this->pengadaanRepository->findWithoutFail($id);
        $title = "Penerimaan Bahan Baku - Lihat";

        if (empty($pengadaan)) {
            Flash::error('Penerimaan Bahan Baku not found');

            return redirect(route('pengadaans.index'));
        }

        return view('pengadaans.show')
        ->with('pengadaan', $pengadaan)
        ->with('title', $title)
        ->with('supplier', $this->pemesanan_bahan_bakus);
    }

    /**
     * Show the form for editing the specified Pengadaan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pengadaan = $this->pengadaanRepository->findWithoutFail($id);
        $title = "Penerimaan Bahan Baku - Edit";
        if (empty($pengadaan)) {
            Flash::error('Penerimaan Bahan Baku not found');

            return redirect(route('pengadaans.index'));
        }

        return view('pengadaans.edit')
              ->with('pengadaan', $pengadaan)
              ->with('bahanBakus', $this->bahanBakus)
              ->with('title', $title)
              ->with('supplier', $this->pemesanan_bahan_bakus);
    }

    /**
     * Update the specified Pengadaan in storage.
     *
     * @param  int              $id
     * @param UpdatePengadaanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePengadaanRequest $request)
    {
        $input = $request->all();

        $pengadaan = $this->pengadaanRepository->findWithoutFail($id);
        $bahan_baku = BahanBaku::find($pengadaan->bahan_baku_id);

        if ($bahan_baku->batas_pengadaan) {
            if ($input['berat'] > $maks = $bahan_baku->batas_pengadaan->maks_pengadaan) {
                Flash::error('Maksimal kuantitas pengadaan '.$bahan_baku->nama_bahan_baku.' adalah '. $maks.' '.$bahan_baku->satuan);
                return redirect()->back()->withInput($input);
            }
        }


        $pengadaan = $this->pengadaanRepository->findWithoutFail($id);
        $bahan_baku = BahanBaku::find($pengadaan->bahan_baku_id);
        $input = $request->all();
        $old_volume = $pengadaan->volume_opname;

        if (empty($pengadaan)) {
            Flash::error('Penerimaan Bahan Baku not found');

            return redirect(route('pengadaans.index'));
        }

        $bahan_baku->sisa += $input['berat'] - $old_volume;

        $bahan_baku->update();
        $pengadaan = $this->pengadaanRepository->update($input, $id);

        $history = $bahan_baku->bahan_baku_histories->where('pengadaan_id', $pengadaan->id)->first();
        $history->bahan_baku_id = $pengadaan->bahan_baku_id;
        $history->type = 2;
        $history->volume = $pengadaan->berat;
        $history->pengadaan_id = $pengadaan->id;
        $history->total_sisa = $bahan_baku->sisa;
        $history->update();

        Flash::success('Penerimaan Bahan Baku updated successfully.');

        return redirect(route('pengadaans.index'));
    }

    /**
     * Remove the specified Pengadaan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pengadaan = $this->pengadaanRepository->findWithoutFail($id);
        $bahan_baku = BahanBaku::find($pengadaan->bahan_baku_id);
        $old_volume = $pengadaan->berat;

        $bahan_baku->sisa -=  $old_volume;
        $bahan_baku->save();

        if (empty($pengadaan)) {
            Flash::error('Penerimaan Bahan Baku not found');

            return redirect(route('pengadaans.index'));
        }

        $this->pengadaanRepository->delete($id);

        Flash::success('Penerimaan Bahan Baku deleted successfully.');

        return redirect(route('pengadaans.index'));
    }
}
