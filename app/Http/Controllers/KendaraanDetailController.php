<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKendaraanDetailRequest;
use App\Http\Requests\UpdateKendaraanDetailRequest;
use App\Repositories\KendaraanDetailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Kendaraan;
use Response;

class KendaraanDetailController extends AppBaseController
{
    /** @var  KendaraanDetailRepository */
    private $kendaraanDetailRepository;

    public function __construct(KendaraanDetailRepository $kendaraanDetailRepo)
    {
        $this->kendaraanDetailRepository = $kendaraanDetailRepo;
    }

    /**
     * Display a listing of the KendaraanDetail.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->kendaraanDetailRepository->pushCriteria(new RequestCriteria($request));
        $kendaraanDetails = $this->kendaraanDetailRepository->all();
        $stt = array(
          '1' => 'Stand By',
          '2' => 'Rusak',
          '3' => 'Rental'
        );

        return view('kendaraan_details.index')
            ->with('kendaraanDetails', $kendaraanDetails)
            ->with('stt', $stt);
    }

    /**
     * Show the form for creating a new KendaraanDetail.
     *
     * @return Response
     */
    public function create()
    {
        $kendaraans = Kendaraan::pluck('jenis_kendaraan', 'id');
        $stt = array(
          '1' => 'Stand By',
          '2' => 'Rusak',
          '3' => 'Rental'
        );
        return view('kendaraan_details.create')
        ->with('kendaraans', $kendaraans)
        ->with('stt', $stt);
    }

    /**
     * Store a newly created KendaraanDetail in storage.
     *
     * @param CreateKendaraanDetailRequest $request
     *
     * @return Response
     */
    public function store(CreateKendaraanDetailRequest $request)
    {
        $input = $request->all();

        $kendaraanDetail = $this->kendaraanDetailRepository->create($input);

        Flash::success('Kendaraan Detail saved successfully.');

        return redirect(route('kendaraanDetails.index'));
    }

    /**
     * Display the specified KendaraanDetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $kendaraanDetail = $this->kendaraanDetailRepository->findWithoutFail($id);
        $stt = array(
          '1' => 'Stand By',
          '2' => 'Rusak',
          '3' => 'Rental'
        );

        if (empty($kendaraanDetail)) {
            Flash::error('Kendaraan Detail not found');

            return redirect(route('kendaraanDetails.index'));
        }

        return view('kendaraan_details.show')->with('kendaraanDetail', $kendaraanDetail)
        ->with('stt', $stt);
    }

    /**
     * Show the form for editing the specified KendaraanDetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $kendaraanDetail = $this->kendaraanDetailRepository->findWithoutFail($id);
        $kendaraans = Kendaraan::pluck('jenis_kendaraan', 'id');
        $stt = array(
            '1' => 'Stand By',
            '2' => 'Rusak',
            '3' => 'Rental'
          );

        if (empty($kendaraanDetail)) {
            Flash::error('Kendaraan Detail not found');

            return redirect(route('kendaraanDetails.index'));
        }

        return view('kendaraan_details.edit')
        ->with('kendaraanDetail', $kendaraanDetail)
        ->with('kendaraans', $kendaraans)
        ->with('stt', $stt);
    }

    /**
     * Update the specified KendaraanDetail in storage.
     *
     * @param  int              $id
     * @param UpdateKendaraanDetailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKendaraanDetailRequest $request)
    {
        $kendaraanDetail = $this->kendaraanDetailRepository->findWithoutFail($id);

        if (empty($kendaraanDetail)) {
            Flash::error('Kendaraan Detail not found');

            return redirect(route('kendaraanDetails.index'));
        }

        $kendaraanDetail = $this->kendaraanDetailRepository->update($request->all(), $id);

        Flash::success('Kendaraan Detail updated successfully.');

        return redirect(route('kendaraanDetails.index'));
    }

    /**
     * Remove the specified KendaraanDetail from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $kendaraanDetail = $this->kendaraanDetailRepository->findWithoutFail($id);

        if (empty($kendaraanDetail)) {
            Flash::error('Kendaraan Detail not found');

            return redirect(route('kendaraanDetails.index'));
        }

        $this->kendaraanDetailRepository->delete($id);

        Flash::success('Kendaraan Detail deleted successfully.');

        return redirect(route('kendaraanDetails.index'));
    }
}
