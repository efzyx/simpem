<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePengadaanRequest;
use App\Http\Requests\UpdatePengadaanRequest;
use App\Repositories\PengadaanRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\BahanBaku;
use Response;
use Auth;

class PengadaanController extends AppBaseController
{
    /** @var  PengadaanRepository */
    private $pengadaanRepository;

    public function __construct(PengadaanRepository $pengadaanRepo)
    {
        $this->pengadaanRepository = $pengadaanRepo;
        $this->bahanBakus = BahanBaku::pluck('nama_bahan_baku', 'id');
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

        return view('pengadaans.index')
            ->with('pengadaans', $pengadaans);
    }

    /**
     * Show the form for creating a new Pengadaan.
     *
     * @return Response
     */
    public function create()
    {
        return view('pengadaans.create')
            ->with('bahanBakus', $this->bahanBakus);
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
        $input['user_id'] = Auth::user()->id;

        $pengadaan = $this->pengadaanRepository->create($input);

        Flash::success('Pengadaan saved successfully.');

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

        if (empty($pengadaan)) {
            Flash::error('Pengadaan not found');

            return redirect(route('pengadaans.index'));
        }

        return view('pengadaans.show')->with('pengadaan', $pengadaan);
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
        $bhnbakus = BahanBaku::pluck('nama_bahan_baku', 'id');
        if (empty($pengadaan)) {
            Flash::error('Pengadaan not found');

            return redirect(route('pengadaans.index'));
        }

        return view('pengadaans.edit')
        ->with('pengadaan', $pengadaan)
        ->with('bahanBakus', $this->bahanBakus);
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
        $pengadaan = $this->pengadaanRepository->findWithoutFail($id);

        if (empty($pengadaan)) {
            Flash::error('Pengadaan not found');

            return redirect(route('pengadaans.index'));
        }

        $pengadaan = $this->pengadaanRepository->update($request->all(), $id);

        Flash::success('Pengadaan updated successfully.');

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

        if (empty($pengadaan)) {
            Flash::error('Pengadaan not found');

            return redirect(route('pengadaans.index'));
        }

        $this->pengadaanRepository->delete($id);

        Flash::success('Pengadaan deleted successfully.');

        return redirect(route('pengadaans.index'));
    }
}
