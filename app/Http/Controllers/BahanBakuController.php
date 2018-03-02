<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBahanBakuRequest;
use App\Http\Requests\UpdateBahanBakuRequest;
use App\Repositories\BahanBakuRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class BahanBakuController extends AppBaseController
{
    /** @var  BahanBakuRepository */
    private $bahanBakuRepository;

    public function __construct(BahanBakuRepository $bahanBakuRepo)
    {
        $this->bahanBakuRepository = $bahanBakuRepo;
    }

    /**
     * Display a listing of the BahanBaku.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bahanBakuRepository->pushCriteria(new RequestCriteria($request));
        $bahanBakus = $this->bahanBakuRepository->all();

        return view('bahan_bakus.index')
            ->with('bahanBakus', $bahanBakus);
    }

    /**
     * Show the form for creating a new BahanBaku.
     *
     * @return Response
     */
    public function create()
    {
        return view('bahan_bakus.create');
    }

    /**
     * Store a newly created BahanBaku in storage.
     *
     * @param CreateBahanBakuRequest $request
     *
     * @return Response
     */
    public function store(CreateBahanBakuRequest $request)
    {
        $input = $request->all();

        $bahanBaku = $this->bahanBakuRepository->create($input);

        Flash::success('Bahan Baku saved successfully.');

        return redirect(route('bahanBakus.index'));
    }

    /**
     * Display the specified BahanBaku.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bahanBaku = $this->bahanBakuRepository->findWithoutFail($id);

        if (empty($bahanBaku)) {
            Flash::error('Bahan Baku not found');

            return redirect(route('bahanBakus.index'));
        }

        return view('bahan_bakus.show')->with('bahanBaku', $bahanBaku);
    }

    /**
     * Show the form for editing the specified BahanBaku.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bahanBaku = $this->bahanBakuRepository->findWithoutFail($id);

        if (empty($bahanBaku)) {
            Flash::error('Bahan Baku not found');

            return redirect(route('bahanBakus.index'));
        }

        return view('bahan_bakus.edit')->with('bahanBaku', $bahanBaku);
    }

    /**
     * Update the specified BahanBaku in storage.
     *
     * @param  int              $id
     * @param UpdateBahanBakuRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBahanBakuRequest $request)
    {
        $bahanBaku = $this->bahanBakuRepository->findWithoutFail($id);

        if (empty($bahanBaku)) {
            Flash::error('Bahan Baku not found');

            return redirect(route('bahanBakus.index'));
        }

        $bahanBaku = $this->bahanBakuRepository->update($request->all(), $id);

        Flash::success('Bahan Baku updated successfully.');

        return redirect(route('bahanBakus.index'));
    }

    /**
     * Remove the specified BahanBaku from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bahanBaku = $this->bahanBakuRepository->findWithoutFail($id);

        if (empty($bahanBaku)) {
            Flash::error('Bahan Baku not found');

            return redirect(route('bahanBakus.index'));
        }

        $this->bahanBakuRepository->delete($id);

        Flash::success('Bahan Baku deleted successfully.');

        return redirect(route('bahanBakus.index'));
    }
}
