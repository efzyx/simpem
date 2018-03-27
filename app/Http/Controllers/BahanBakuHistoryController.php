<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBahanBakuHistoryRequest;
use App\Http\Requests\UpdateBahanBakuHistoryRequest;
use App\Repositories\BahanBakuHistoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class BahanBakuHistoryController extends AppBaseController
{
    /** @var  BahanBakuHistoryRepository */
    private $bahanBakuHistoryRepository;

    public function __construct(BahanBakuHistoryRepository $bahanBakuHistoryRepo)
    {
        $this->bahanBakuHistoryRepository = $bahanBakuHistoryRepo;
    }

    /**
     * Display a listing of the BahanBakuHistory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bahanBakuHistoryRepository->pushCriteria(new RequestCriteria($request));
        $bahanBakuHistories = $this->bahanBakuHistoryRepository->all();
        $title = "Riwayat Bahan Baku";

        return view('bahan_baku_histories.index')
              ->with('bahanBakuHistories', $bahanBakuHistories)
              ->with('title', $title);
    }

    /**
     * Show the form for creating a new BahanBakuHistory.
     *
     * @return Response
     */
    public function create()
    {
        $title = "Riwayat Bahan Baku - Tambah";
        return view('bahan_baku_histories.create')
              ->with('title', $title);
    }

    /**
     * Store a newly created BahanBakuHistory in storage.
     *
     * @param CreateBahanBakuHistoryRequest $request
     *
     * @return Response
     */
    public function store(CreateBahanBakuHistoryRequest $request)
    {
        $input = $request->all();

        $bahanBakuHistory = $this->bahanBakuHistoryRepository->create($input);

        Flash::success('Bahan Baku History saved successfully.');

        return redirect(route('bahanBakuHistories.index'));
    }

    /**
     * Display the specified BahanBakuHistory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bahanBakuHistory = $this->bahanBakuHistoryRepository->findWithoutFail($id);
        $title = "Riwayat Bahan Baku - Lihat";

        if (empty($bahanBakuHistory)) {
            Flash::error('Bahan Baku History not found');

            return redirect(route('bahanBakuHistories.index'));
        }

        return view('bahan_baku_histories.show')
              ->with('bahanBakuHistory', $bahanBakuHistory)
              ->with('title', $title);
    }

    /**
     * Show the form for editing the specified BahanBakuHistory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bahanBakuHistory = $this->bahanBakuHistoryRepository->findWithoutFail($id);
        $title = "Riwayat Bahan Baku - Edit";

        if (empty($bahanBakuHistory)) {
            Flash::error('Bahan Baku History not found');

            return redirect(route('bahanBakuHistories.index'));
        }

        return view('bahan_baku_histories.edit')
              ->with('bahanBakuHistory', $bahanBakuHistory)
              ->with('title', $title);
    }

    /**
     * Update the specified BahanBakuHistory in storage.
     *
     * @param  int              $id
     * @param UpdateBahanBakuHistoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBahanBakuHistoryRequest $request)
    {
        $bahanBakuHistory = $this->bahanBakuHistoryRepository->findWithoutFail($id);

        if (empty($bahanBakuHistory)) {
            Flash::error('Bahan Baku History not found');

            return redirect(route('bahanBakuHistories.index'));
        }

        $bahanBakuHistory = $this->bahanBakuHistoryRepository->update($request->all(), $id);

        Flash::success('Bahan Baku History updated successfully.');

        return redirect(route('bahanBakuHistories.index'));
    }

    /**
     * Remove the specified BahanBakuHistory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bahanBakuHistory = $this->bahanBakuHistoryRepository->findWithoutFail($id);

        if (empty($bahanBakuHistory)) {
            Flash::error('Bahan Baku History not found');

            return redirect(route('bahanBakuHistories.index'));
        }

        $this->bahanBakuHistoryRepository->delete($id);

        Flash::success('Bahan Baku History deleted successfully.');

        return redirect(route('bahanBakuHistories.index'));
    }
}
