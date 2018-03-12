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

class PemesananController extends AppBaseController
{
    /** @var  PemesananRepository */
    private $pemesananRepository;

    public function __construct(PemesananRepository $pemesananRepo)
    {
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
        $pemesanans = $this->pemesananRepository->paginate(10);
        $produks = Produk::pluck('mutu_produk', 'id');

        return view('pemesanans.index')
            ->with('pemesanans', $pemesanans)
            ->with('produks', $produks);
    }

    /**
     * Show the form for creating a new Pemesanan.
     *
     * @return Response
     */
    public function create()
    {
        $produks = Produk::pluck('mutu_produk', 'id');
        return view('pemesanans.create')
              ->with('produks', $produks);
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

        if (empty($pemesanan)) {
            Flash::error('Pemesanan not found');

            return redirect(route('pemesanans.index'));
        }

        return view('pemesanans.show')->with('pemesanan', $pemesanan);
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

        return view('pemesanans.edit')
              ->with('pemesanan', $pemesanan)
              ->with('produks', $produks);
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

        if (empty($pemesanan)) {
            Flash::error('Pemesanan not found');

            return redirect(route('pemesanans.index'));
        }

        $pemesanan = $this->pemesananRepository->update($request->all(), $id);

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

    public function downloadPdf()
    {
        $pdf = PDF::loadView('pemesanans.pdf', ['pemesanans' => $this->pemesananRepository->paginate(10)]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('pemesanan_'.time().'.pdf');
    }
}
