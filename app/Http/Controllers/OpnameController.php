<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOpnameRequest;
use App\Http\Requests\UpdateOpnameRequest;
use App\Repositories\OpnameRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\BahanBaku;
use App\Models\BahanBakuHistory;
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
        $this->middleware('role:admin,manager_produksi');
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
        $title = "Opname";

        return view('opnames.index')
            ->with('opnames', $opnames)
            ->with('title', $title);
    }

    /**
     * Show the form for creating a new Opname.
     *
     * @return Response
     */
    public function create()
    {
        $title = "Opname - Tambah";
        return view('opnames.create')
              ->with('bahanBakus', $this->bahanBakus)
              ->with('title', $title);
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
        $bahan_baku->sisa -= $opname->volume_opname;

        if ($bahan_baku->sisa <= 0) {
            Flash::error('Bahan Baku Kurang');
            return redirect()->back()->withInput($input);
        }

        $bahan_baku->save();

        $history = new BahanBakuHistory();
        $history->bahan_baku_id = $opname->bahan_baku_id;
        $history->type = 1;
        $history->opname_id = $opname->id;
        $history->volume = $opname->volume_opname;
        $history->total_sisa = $bahan_baku->sisa;
        $history->save();

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
        $title = "Opname - Lihat";

        if (empty($opname)) {
            Flash::error('Opname not found');

            return redirect(route('opnames.index'));
        }

        return view('opnames.show')->with('opname', $opname)->with('title', $title);
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
        $title = "Opname - Edit";

        if (empty($opname)) {
            Flash::error('Opname not found');

            return redirect(route('opnames.index'));
        }

        return view('opnames.edit')
              ->with('opname', $opname)
              ->with('bahanBakus', $this->bahanBakus)
              ->with('title', $title);
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
        $input = $request->all();
        $old_volume = $opname->volume_opname;


        if (empty($opname)) {
            Flash::error('Opname not found');

            return redirect(route('opnames.index'));
        }

        $bahan_baku->sisa -= $input['volume_opname'] - $old_volume;

        if ($bahan_baku->sisa <= 0) {
            Flash::error('Bahan Baku Kurang');
            return redirect()->back()->withInput($input);
        }

        $bahan_baku->update();

        $opname = $this->opnameRepository->update($input, $id);

        $history = $bahan_baku->bahan_baku_histories->where('opname_id', $opname->id)->first();
        $history->bahan_baku_id = $opname->bahan_baku_id;
        $history->type = 1;
        $history->opname_id = $opname->id;
        $history->volume = $opname->volume_opname;
        $history->total_sisa = $bahan_baku->sisa;
        $history->update();


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
        $old_volume = $opname->volume_opname;

        $bahan_baku->sisa +=  $old_volume;
        $bahan_baku->update();

        if (empty($opname)) {
            Flash::error('Opname not found');

            return redirect(route('opnames.index'));
        }

        $this->opnameRepository->delete($id);

        Flash::success('Opname deleted successfully.');

        return redirect(route('opnames.index'));
    }
}
