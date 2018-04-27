<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePemesananRequest;
use App\Http\Requests\UpdatePemesananRequest;
use App\Repositories\PemesananRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Produk;
use Response;
use PDF;
use Auth;
use Carbon\Carbon;
use App\Models\Pemesanan;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\DB;

class PemesananController extends AppBaseController
{
    /** @var  PemesananRepository */
    private $pemesananRepository;

    public function __construct(PemesananRepository $pemesananRepo)
    {
        $this->kendaraans = Kendaraan::select(DB::raw("concat(no_polisi, ' - ', jenis_kendaraan) as nama"), 'id')
                        ->pluck('nama', 'id');
        $this->middleware('role:admin,marketing,produksi,manager_produksi')
              ->only('index', 'filter', 'show');
        $this->middleware('role:marketing')->except('index', 'filter', 'show');
        $this->pemesananRepository = $pemesananRepo;
    }

    /**
     * Display a listing of the Pemesanan.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pemesananRepository->pushCriteria(new RequestCriteria($request));
        $pemesanans = $this->pemesananRepository->all();
        $title = 'Pemesanan';
        return view('pemesanans.index')
            ->with('pemesanans', $pemesanans)
            ->with('title', $title);
    }

    public function filter(Request $request)
    {
        $this->pemesananRepository->pushCriteria(new RequestCriteria($request));
        $pemesanans = $this->pemesananRepository->all();
        $pemesanans = $pemesanans->filter(function ($pemesanan) use ($request) {
            return $request['jenis_pesanan'] != null ?
                  $pemesanan->jenis_pesanan == $request['jenis_pesanan'] :
                  $pemesanan;
        });
        $pemesanans = $pemesanans->filter(function ($pemesanan) use ($request) {
            $dari = $request['tanggal_kirim_dari'] ? Carbon::parse($request['tanggal_kirim_dari']) : null;
            $sampai = $request['tanggal_kirim_sampai'] ? Carbon::parse($request['tanggal_kirim_sampai']) : null;
            if ($dari) {
                if ($sampai) {
                    return ($pemesanan->tanggal_kirim_dari >= $dari &&
                         $pemesanan->tanggal_kirim_sampai < $sampai->addDays(1)) ||
                         ($pemesanan->tanggal_kirim_dari >= $dari &&
                         $pemesanan->tanggal_kirim_dari < $dari->addDays(1)) ||
                         ($pemesanan->tanggal_kirim_sampai >= $dari &&
                          $pemesanan->tanggal_kirim_sampai < $dari->addDays(1));
                }
                return $pemesanan->tanggal_kirim_dari >= $dari &&
                 $pemesanan->tanggal_kirim_dari < $dari->addDays(1) ||
                 ($pemesanan->tanggal_kirim_sampai >= $dari &&
                 $pemesanan->tanggal_kirim_sampai < $dari->addDays(1));;
            }

            return $pemesanan;
        });

        $title = 'Pemesanan - Filter';

        return view('pemesanans.index')
              ->with('pemesanans', $pemesanans)
              ->with('title', $title);
    }


    /**
     * Display the specified Pemesanan.
     *
     * @param  int $id
     *
     * @return Response
     */

    /**
     * Show the form for creating a new Pemesanan.
     *
     * @return Response
     */
    public function create()
    {
        $produks = Produk::pluck('mutu_produk', 'id');
        $title = 'Pemesanan - Tambah';
        return view('pemesanans.create')
              ->with('produks', $produks)
              ->with('title', $title);
    }

    /**
     * Store a newly created Pemesanan in storage.
     *
     * @param CreatePemesananRequest $request
     *
     * @return Response
     */
    public function store(CreatePemesananRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        $pemesanan = $this->pemesananRepository->create($input);

        Flash::success('Pemesanan saved successfully.');

        return redirect(route('pemesanans.index'));
    }

    /**
     * Display the specified Pemesanan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pemesanan = $this->pemesananRepository->findWithoutFail($id);
        $title = 'Pemesanan - Lihat';

        if (empty($pemesanan)) {
            Flash::error('Pemesanan not found');

            return redirect(route('pemesanans.index'));
        }

        return view('pemesanans.show')
                ->with('pemesanan', $pemesanan)
                ->with('title', $title);
    }

    /**
     * Show the form for editing the specified Pemesanan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pemesanan = $this->pemesananRepository->findWithoutFail($id);
        $produks = Produk::pluck('mutu_produk', 'id');
        if (empty($pemesanan)) {
            Flash::error('Pemesanan not found');

            return redirect(route('pemesanans.index'));
        }

        $title = 'Pemesanan - Edit';
        return view('pemesanans.edit')
              ->with('pemesanan', $pemesanan)
              ->with('produks', $produks)
              ->with('title', $title);
    }

    /**
     * Update the specified Pemesanan in storage.
     *
     * @param  int              $id
     * @param UpdatePemesananRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePemesananRequest $request)
    {
        $pemesanan = $this->pemesananRepository->findWithoutFail($id);
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        $produksis = $pemesanan->produksis;
        $old_volume = $pemesanan->volume_pesanan;
        $old_produk = $pemesanan->produk_id;

        if ($produksis->count() &&
           ($input['volume_pesanan'] != $old_volume ||
           $input['produk_id'] != $old_produk)) {
            Flash::error('Proses produksi sedang berjalan, tidak bisa rubah jenis produk dan atau volume pesanan');
            return redirect()->back();
        }

        if (empty($pemesanan)) {
            Flash::error('Pemesanan not found');

            return redirect(route('pemesanans.index'));
        }

        $pemesanan = $this->pemesananRepository->update($input, $id);

        Flash::success('Pemesanan updated successfully.');

        return redirect(route('pemesanans.index'));
    }

    /**
     * Remove the specified Pemesanan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pemesanan = $this->pemesananRepository->findWithoutFail($id);

        if (empty($pemesanan)) {
            Flash::error('Pemesanan not found');

            return redirect(route('pemesanans.index'));
        }

        $this->pemesananRepository->delete($id);

        Flash::success('Pemesanan deleted successfully.');

        return redirect(route('pemesanans.index'));
    }

    public function downloadPdf(Request $request)
    {
        $data = json_decode($request['pemesanans'], true);
        $pemesanans = Pemesanan::hydrate($data);
        $pemesanans = $pemesanans->flatten();
        $user =  Auth::user()->name;
        $pdf = PDF::loadView('pemesanans.pdf', ['pemesanans' => $pemesanans,'user'=>$user, 'kendaraans' => $this->kendaraans]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('pemesanan_'.time().'.pdf');
    }
}
