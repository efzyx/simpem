<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createpemesanan_bahan_bakuRequest;
use App\Http\Requests\Updatepemesanan_bahan_bakuRequest;
use App\Repositories\pemesanan_bahan_bakuRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\BahanBaku;

class pemesanan_bahan_bakuController extends AppBaseController
{
    /** @var  pemesanan_bahan_bakuRepository */
    private $pemesananBahanBakuRepository;

    public function __construct(pemesanan_bahan_bakuRepository $pemesananBahanBakuRepo)
    {
        $this->pemesananBahanBakuRepository = $pemesananBahanBakuRepo;
        $this->bahanBakus = BahanBaku::pluck('nama_bahan_baku', 'id');
        $this->middleware('role:admin,manager_produksi,logistik')->only('index', 'show');
        $this->middleware('role:logistik')->except('index', 'show');
    }

    /**
     * Display a listing of the pemesanan_bahan_baku.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pemesananBahanBakuRepository->pushCriteria(new RequestCriteria($request));
        $pemesananBahanBakus = $this->pemesananBahanBakuRepository->paginate(10);
        $title = 'Pemesanan Bahan Baku';

        return view('pemesanan_bahan_bakus.index')
            ->with('pemesananBahanBakus', $pemesananBahanBakus)
            ->with('title', $title)
            ->with('bahan_baku', $this->bahanBakus);
    }

    /**
     * Show the form for creating a new pemesanan_bahan_baku.
     *
     * @return Response
     */
    public function create()
    {
        $title = 'Pemesanan Bahan Baku - Tambah';
        return view('pemesanan_bahan_bakus.create')
          ->with('bahanBakus', $this->bahanBakus)
          ->with('title', $title);
    }

    /**
     * Store a newly created pemesanan_bahan_baku in storage.
     *
     * @param Createpemesanan_bahan_bakuRequest $request
     *
     * @return Response
     */
    public function store(Createpemesanan_bahan_bakuRequest $request)
    {
        $input = $request->all();

        $pemesananBahanBaku = $this->pemesananBahanBakuRepository->create($input);

        Flash::success('Pemesanan Bahan Baku saved successfully.');

        return redirect(route('pemesananBahanBakus.index'));
    }

    /**
     * Display the specified pemesanan_bahan_baku.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pemesananBahanBaku = $this->pemesananBahanBakuRepository->findWithoutFail($id);
        $title = 'Pemesanan Bahan Baku - Lihat';
        if (empty($pemesananBahanBaku)) {
            Flash::error('Pemesanan Bahan Baku not found');

            return redirect(route('pemesananBahanBakus.index'));
        }

        return view('pemesanan_bahan_bakus.show')
          ->with('pemesananBahanBaku', $pemesananBahanBaku)
          ->with('title', $title);
    }

    /**
     * Show the form for editing the specified pemesanan_bahan_baku.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pemesananBahanBaku = $this->pemesananBahanBakuRepository->findWithoutFail($id);

        if (empty($pemesananBahanBaku)) {
            Flash::error('Pemesanan Bahan Baku not found');

            return redirect(route('pemesananBahanBakus.index'));
        }
        $title = 'Pemesanan Bahan Baku - Lihat';

        return view('pemesanan_bahan_bakus.edit')
        ->with('pemesananBahanBaku', $pemesananBahanBaku)
        ->with('title', $title);
    }

    /**
     * Update the specified pemesanan_bahan_baku in storage.
     *
     * @param  int              $id
     * @param Updatepemesanan_bahan_bakuRequest $request
     *
     * @return Response
     */
    public function update($id, Updatepemesanan_bahan_bakuRequest $request)
    {
        $pemesananBahanBaku = $this->pemesananBahanBakuRepository->findWithoutFail($id);

        if (empty($pemesananBahanBaku)) {
            Flash::error('Pemesanan Bahan Baku not found');

            return redirect(route('pemesananBahanBakus.index'));
        }

        $pemesananBahanBaku = $this->pemesananBahanBakuRepository->update($request->all(), $id);

        Flash::success('Pemesanan Bahan Baku updated successfully.');

        return redirect(route('pemesananBahanBakus.index'));
    }

    /**
     * Remove the specified pemesanan_bahan_baku from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pemesananBahanBaku = $this->pemesananBahanBakuRepository->findWithoutFail($id);

        if (empty($pemesananBahanBaku)) {
            Flash::error('Pemesanan Bahan Baku not found');

            return redirect(route('pemesananBahanBakus.index'));
        }

        $this->pemesananBahanBakuRepository->delete($id);

        Flash::success('Pemesanan Bahan Baku deleted successfully.');

        return redirect(route('pemesananBahanBakus.index'));
    }
}
