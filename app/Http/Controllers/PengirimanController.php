<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePengirimanRequest;
use App\Http\Requests\UpdatePengirimanRequest;
use App\Repositories\PengirimanRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class PengirimanController extends AppBaseController
{
    /** @var  PengirimanRepository */
    private $pengirimanRepository;

    public function __construct(PengirimanRepository $pengirimanRepo)
    {
        $this->pengirimanRepository = $pengirimanRepo;
        $this->middleware('role:admin,marketing,produksi,manager_produksi')
                          ->only('index', 'show');
        $this->middleware('role:produksi')->except('index', 'show');
    }

    /**
     * Display a listing of the Pengiriman.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pengirimanRepository->pushCriteria(new RequestCriteria($request));
        $pengiriman = $this->pengirimanRepository->all();
        $title = "Pengiriman";

        return view('pengiriman.index')
              ->with('pengiriman', $pengiriman)
              ->with('title', $title);
    }

    /**
     * Show the form for creating a new Pengiriman.
     *
     * @return Response
     */
    public function create()
    {
        $title = "Pengiriman - Tambah";
        return view('pengiriman.create')
              ->with('title', $title);
    }

    /**
     * Store a newly created Pengiriman in storage.
     *
     * @param CreatePengirimanRequest $request
     *
     * @return Response
     */
    public function store(CreatePengirimanRequest $request)
    {
        $input = $request->all();

        $pengiriman = $this->pengirimanRepository->create($input);

        Flash::success('Pengiriman saved successfully.');

        return redirect(route('pengiriman.index'));
    }

    /**
     * Display the specified Pengiriman.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pengiriman = $this->pengirimanRepository->findWithoutFail($id);
        $title = "Pengiriman - Lihat";

        if (empty($pengiriman)) {
            Flash::error('Pengiriman not found');

            return redirect(route('pengiriman.index'));
        }

        return view('pengiriman.show')->with('pengiriman', $pengiriman)->with('title', $title);
    }

    /**
     * Show the form for editing the specified Pengiriman.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pengiriman = $this->pengirimanRepository->findWithoutFail($id);
        $title = "Pengiriman - Edit";

        if (empty($pengiriman)) {
            Flash::error('Pengiriman not found');

            return redirect(route('pengiriman.index'));
        }

        return view('pengiriman.edit')
              ->with('pengiriman', $pengiriman)
              ->with('title', $title);
    }

    /**
     * Update the specified Pengiriman in storage.
     *
     * @param  int              $id
     * @param UpdatePengirimanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePengirimanRequest $request)
    {
        $pengiriman = $this->pengirimanRepository->findWithoutFail($id);


        if (empty($pengiriman)) {
            Flash::error('Pengiriman not found');

            return redirect()->back();
        }

        $pengiriman->user_id = Auth::user()->id;
        $pengiriman = $this->pengirimanRepository->update($request->all(), $id);

        if ($pengiriman->status == 2) {
            $pengiriman->produksi->kendaraan->kendaraanDetails()->create([
            'status' => 1,
            'waktu'  => $pengiriman->produksi->waktu_produksi
          ]);
        }

        Flash::success('Status updated successfully.');

        return redirect()->back();
    }

    /**
     * Remove the specified Pengiriman from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pengiriman = $this->pengirimanRepository->findWithoutFail($id);

        if (empty($pengiriman)) {
            Flash::error('Pengiriman not found');

            return redirect(route('pengiriman.index'));
        }

        $this->pengirimanRepository->delete($id);

        Flash::success('Pengiriman deleted successfully.');

        return redirect(route('pengiriman.index'));
    }
}
