<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKomposisiMutuRequest;
use App\Http\Requests\UpdateKomposisiMutuRequest;
use App\Repositories\KomposisiMutuRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class KomposisiMutuController extends AppBaseController
{
    /** @var  KomposisiMutuRepository */
    private $komposisiMutuRepository;

    public function __construct(KomposisiMutuRepository $komposisiMutuRepo)
    {
        $this->komposisiMutuRepository = $komposisiMutuRepo;
    }

    /**
     * Display a listing of the KomposisiMutu.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->komposisiMutuRepository->pushCriteria(new RequestCriteria($request));
        $komposisiMutus = $this->komposisiMutuRepository->all();

        return view('komposisi_mutus.index')
            ->with('komposisiMutus', $komposisiMutus);
    }

    /**
     * Show the form for creating a new KomposisiMutu.
     *
     * @return Response
     */
    public function create()
    {
        return view('komposisi_mutus.create');
    }

    /**
     * Store a newly created KomposisiMutu in storage.
     *
     * @param CreateKomposisiMutuRequest $request
     *
     * @return Response
     */
    public function store(CreateKomposisiMutuRequest $request)
    {
        $input = $request->all();

        $komposisiMutu = $this->komposisiMutuRepository->create($input);

        Flash::success('Komposisi Mutu saved successfully.');

        return redirect(route('komposisiMutus.index'));
    }

    /**
     * Display the specified KomposisiMutu.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $komposisiMutu = $this->komposisiMutuRepository->findWithoutFail($id);

        if (empty($komposisiMutu)) {
            Flash::error('Komposisi Mutu not found');

            return redirect(route('komposisiMutus.index'));
        }

        return view('komposisi_mutus.show')->with('komposisiMutu', $komposisiMutu);
    }

    /**
     * Show the form for editing the specified KomposisiMutu.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $komposisiMutu = $this->komposisiMutuRepository->findWithoutFail($id);

        if (empty($komposisiMutu)) {
            Flash::error('Komposisi Mutu not found');

            return redirect(route('komposisiMutus.index'));
        }

        return view('komposisi_mutus.edit')->with('komposisiMutu', $komposisiMutu);
    }

    /**
     * Update the specified KomposisiMutu in storage.
     *
     * @param  int              $id
     * @param UpdateKomposisiMutuRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKomposisiMutuRequest $request)
    {
        $komposisiMutu = $this->komposisiMutuRepository->findWithoutFail($id);

        if (empty($komposisiMutu)) {
            Flash::error('Komposisi Mutu not found');

            return redirect(route('komposisiMutus.index'));
        }

        $komposisiMutu = $this->komposisiMutuRepository->update($request->all(), $id);

        Flash::success('Komposisi Mutu updated successfully.');

        return redirect(route('komposisiMutus.index'));
    }

    /**
     * Remove the specified KomposisiMutu from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $komposisiMutu = $this->komposisiMutuRepository->findWithoutFail($id);

        if (empty($komposisiMutu)) {
            Flash::error('Komposisi Mutu not found');

            return redirect(route('komposisiMutus.index'));
        }

        $this->komposisiMutuRepository->delete($id);

        Flash::success('Komposisi Mutu deleted successfully.');

        return redirect(route('komposisiMutus.index'));
    }
}
