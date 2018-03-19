<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOpnameRequest;
use App\Http\Requests\UpdateOpnameRequest;
use App\Repositories\OpnameRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\BahanBaku;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class OpnameController extends AppBaseController
{
    /** @var  OpnameRepository */
    private $opnameRepository;

    public function __construct(OpnameRepository $opnameRepo)
    {
        $this->opnameRepository = $opnameRepo;
        $this->bahanBakus = BahanBaku::pluck('nama_bahan_baku', 'id');
    }

    /**
     * Display a listing of the Opname.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->opnameRepository->pushCriteria(new RequestCriteria($request));
        $opnames = $this->opnameRepository->paginate(10);

        return view('opnames.index')
            ->with('opnames', $opnames);
    }

    /**
     * Show the form for creating a new Opname.
     *
     * @return Response
     */
    public function create()
    {
        return view('opnames.create')
        ->with('bahanBakus', $this->bahanBakus);
    }

    /**
     * Store a newly created Opname in storage.
     *
     * @param CreateOpnameRequest $request
     *
     * @return Response
     */
    public function store(CreateOpnameRequest $request)
    {
        $input = $request->all();

        $opname = $this->opnameRepository->create($input);

        $bahan_baku = BahanBaku::find($opname->bahan_baku_id);
        $sisa = $bahan_baku->sisa - $opname->volume_opname;

        if ($sisa>0) {
            $bahan_baku->sisa = $sisa;
            $bahan_baku->save();
        } else {
            Flash::error('Bahan Baku Kurang');
            return redirect()->back()->withInput($input);
        }

        Flash::success('Opname saved successfully.');

        return redirect(route('opnames.index'));
    }

    /**
     * Display the specified Opname.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $opname = $this->opnameRepository->findWithoutFail($id);

        if (empty($opname)) {
            Flash::error('Opname not found');

            return redirect(route('opnames.index'));
        }

        return view('opnames.show')->with('opname', $opname);
    }

    /**
     * Show the form for editing the specified Opname.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $opname = $this->opnameRepository->findWithoutFail($id);

        if (empty($opname)) {
            Flash::error('Opname not found');

            return redirect(route('opnames.index'));
        }

        return view('opnames.edit')
        ->with('opname', $opname)
        ->with('bahanBakus', $this->bahanBakus);
    }

    /**
     * Update the specified Opname in storage.
     *
     * @param  int              $id
     * @param UpdateOpnameRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOpnameRequest $request)
    {
        $opname = $this->opnameRepository->findWithoutFail($id);
        $bahan_baku = BahanBaku::find($opname->bahan_baku_id);
        $berat = $opname->volume_opname;


        if (empty($opname)) {
            Flash::error('Opname not found');

            return redirect(route('opnames.index'));
        }

        $opname = $this->opnameRepository->update($request->all(), $id);

        if ($berat > $opname->volume_opname) {
            $berat = $berat - $opname->volume_opname;
            $bahan_baku->sisa = $bahan_baku->sisa + $berat;
        } else {
            $berat = $opname->volume_opname - $berat;
            $bahan_baku->sisa = $bahan_baku->sisa - $berat;
        }
        $bahan_baku->save();

        Flash::success('Opname updated successfully.');

        return redirect(route('opnames.index'));
    }

    /**
     * Remove the specified Opname from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $opname = $this->opnameRepository->findWithoutFail($id);
        $bahan_baku = BahanBaku::find($opname->bahan_baku_id);
        $berat = $opname->volume_opname;
        $bahan_baku->sisa = $bahan_baku->sisa + $berat;
        $bahan_baku->save();

        if (empty($opname)) {
            Flash::error('Opname not found');

            return redirect(route('opnames.index'));
        }

        $this->opnameRepository->delete($id);

        Flash::success('Opname deleted successfully.');

        return redirect(route('opnames.index'));
    }
}
