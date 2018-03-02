<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOpnameRequest;
use App\Http\Requests\UpdateOpnameRequest;
use App\Repositories\OpnameRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
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
        $opnames = $this->opnameRepository->all();

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
        return view('opnames.create');
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

        return view('opnames.edit')->with('opname', $opname);
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

        if (empty($opname)) {
            Flash::error('Opname not found');

            return redirect(route('opnames.index'));
        }

        $opname = $this->opnameRepository->update($request->all(), $id);

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

        if (empty($opname)) {
            Flash::error('Opname not found');

            return redirect(route('opnames.index'));
        }

        $this->opnameRepository->delete($id);

        Flash::success('Opname deleted successfully.');

        return redirect(route('opnames.index'));
    }
}
