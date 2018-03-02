<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupirRequest;
use App\Http\Requests\UpdateSupirRequest;
use App\Repositories\SupirRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SupirController extends AppBaseController
{
    /** @var  SupirRepository */
    private $supirRepository;

    public function __construct(SupirRepository $supirRepo)
    {
        $this->supirRepository = $supirRepo;
    }

    /**
     * Display a listing of the Supir.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->supirRepository->pushCriteria(new RequestCriteria($request));
        $supirs = $this->supirRepository->all();

        return view('supirs.index')
            ->with('supirs', $supirs);
    }

    /**
     * Show the form for creating a new Supir.
     *
     * @return Response
     */
    public function create()
    {
        return view('supirs.create');
    }

    /**
     * Store a newly created Supir in storage.
     *
     * @param CreateSupirRequest $request
     *
     * @return Response
     */
    public function store(CreateSupirRequest $request)
    {
        $input = $request->all();

        $supir = $this->supirRepository->create($input);

        Flash::success('Supir saved successfully.');

        return redirect(route('supirs.index'));
    }

    /**
     * Display the specified Supir.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $supir = $this->supirRepository->findWithoutFail($id);

        if (empty($supir)) {
            Flash::error('Supir not found');

            return redirect(route('supirs.index'));
        }

        return view('supirs.show')->with('supir', $supir);
    }

    /**
     * Show the form for editing the specified Supir.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $supir = $this->supirRepository->findWithoutFail($id);

        if (empty($supir)) {
            Flash::error('Supir not found');

            return redirect(route('supirs.index'));
        }

        return view('supirs.edit')->with('supir', $supir);
    }

    /**
     * Update the specified Supir in storage.
     *
     * @param  int              $id
     * @param UpdateSupirRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSupirRequest $request)
    {
        $supir = $this->supirRepository->findWithoutFail($id);

        if (empty($supir)) {
            Flash::error('Supir not found');

            return redirect(route('supirs.index'));
        }

        $supir = $this->supirRepository->update($request->all(), $id);

        Flash::success('Supir updated successfully.');

        return redirect(route('supirs.index'));
    }

    /**
     * Remove the specified Supir from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $supir = $this->supirRepository->findWithoutFail($id);

        if (empty($supir)) {
            Flash::error('Supir not found');

            return redirect(route('supirs.index'));
        }

        $this->supirRepository->delete($id);

        Flash::success('Supir deleted successfully.');

        return redirect(route('supirs.index'));
    }
}
