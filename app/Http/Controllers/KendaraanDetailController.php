<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKendaraanDetailRequest;
use App\Http\Requests\UpdateKendaraanDetailRequest;
use App\Repositories\KendaraanDetailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use PDF;
use Auth;
use Carbon\Carbon;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Kendaraan;
use App\Models\KendaraanDetail;
use Response;

class KendaraanDetailController extends AppBaseController
{
    /** @var  KendaraanDetailRepository */
    private $kendaraanDetailRepository;

    public function __construct(KendaraanDetailRepository $kendaraanDetailRepo)
    {
        $this->kendaraanDetailRepository = $kendaraanDetailRepo;
        $this->status = [
          '1' => 'Stand By',
          '2' => 'Rusak',
          '3' => 'Rental'
        ];
        $this->middleware('role:admin,manager_produksi,produksi');
    }

    /**
     * Display a listing of the KendaraanDetail.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Kendaraan $kendaraan, Request $request)
    {
        $kendaraanDetails = $kendaraan->kendaraanDetails()->orderBy('waktu', 'desc')->get();
        $title = "Detail Kendaraan";

        return view('kendaraan_details.index')
            ->with('kendaraanDetails', $kendaraanDetails)
            ->with('status', $this->status)
            ->with('kendaraan', $kendaraan)
            ->with('title', $title);
    }

    /**
     * Show the form for creating a new KendaraanDetail.
     *
     * @return Response
     */
    public function create(Kendaraan $kendaraan)
    {
        $kendaraans = Kendaraan::pluck('jenis_kendaraan', 'id');
        $title = "Detail Kendaraan - Tambah";

        return view('kendaraan_details.create')
              ->with('kendaraans', $kendaraans)
              ->with('status', $this->status)
              ->with('kendaraan', $kendaraan)
              ->with('title', $title);
    }

    /**
     * Store a newly created KendaraanDetail in storage.
     *
     * @param CreateKendaraanDetailRequest $request
     *
     * @return Response
     */
    public function store(Kendaraan $kendaraan, CreateKendaraanDetailRequest $request)
    {
        $input = $request->all();
        $input['kendaraan_id'] = $kendaraan->id;
        $kendaraanDetail = $this->kendaraanDetailRepository->create($input);

        Flash::success('Status Kendaraan saved successfully.');

        return redirect(route('kendaraans.kendaraanDetails.index', $kendaraan));
    }

    public function filter(Kendaraan $kendaraan, Request $request)
    {
        $this->kendaraanDetailRepository->pushCriteria(new RequestCriteria($request));
        $statuss = $this->kendaraanDetailRepository->orderBy('id', 'desc')->all();
        $statuss = $statuss->filter(function ($status) use ($request) {
            $dari = $request['tanggal_kirim_dari'] ? Carbon::parse($request['tanggal_kirim_dari']) : null;
            $sampai = $request['tanggal_kirim_sampai'] ? Carbon::parse($request['tanggal_kirim_sampai']) : null;
            if ($dari) {
                if ($sampai) {
                    return ($status->waktu >= $dari &&
                         $status->waktu < $sampai->addDays(1)) ||
                         ($status->waktu >= $dari &&
                         $status->waktu < $dari->addDays(1));
                }
                return $status->waktu >= $dari &&
                 $status->waktu < $dari->addDays(1);
            }
            return $status;
        });
        $statuss = $statuss->filter(function ($status) use ($kendaraan) {
            return $kendaraan->id ?
                   $status->kendaraan_id == $kendaraan->id :
                   $status;
        });

        $title = 'Status Kendaraan - Filter';

        return view('kendaraan_details.index')
              ->with('kendaraanDetails', $statuss)
              ->with('kendaraan', $kendaraan)
              ->with('status', $this->status)
              ->with('title', $title);
    }

    public function downloadPdf(Kendaraan $kendaraan, Request $request)
    {
        $data = json_decode($request['kendaraanDetails'], true);
        $details = KendaraanDetail::hydrate($data);
        $details = $details->flatten();
        $user =  Auth::user()->name;
        $pdf = PDF::loadView('kendaraan_details.pdf', ['details' => $details,'user'=>$user, 'kendaraan' => $kendaraan, 'status' => $this->status]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('status_kendaraan_'.time().'.pdf');
    }

    /**
     * Display the specified KendaraanDetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Kendaraan $kendaraan, $id)
    {
        $kendaraanDetail = $this->kendaraanDetailRepository->findWithoutFail($id);
        $title = "Detail Kendaraan - Lihat";

        if (empty($kendaraanDetail)) {
            Flash::error('Kendaraan Detail not found');

            return redirect(route('kendaraans.kendaraanDetails.index', $kendaraan));
        }

        return view('kendaraan_details.show')
              ->with('kendaraanDetail', $kendaraanDetail)
              ->with('status', $this->status)
              ->with('kendaraan', $kendaraan)
              ->with('title', $title);
    }

    /**
     * Show the form for editing the specified KendaraanDetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Kendaraan $kendaraan, $id)
    {
        $kendaraanDetail = $this->kendaraanDetailRepository->findWithoutFail($id);
        $kendaraans = Kendaraan::pluck('jenis_kendaraan', 'id');
        $title = "Detail Kendaraan - Edit";

        if (empty($kendaraanDetail)) {
            Flash::error('Kendaraan Detail not found');

            return redirect(route('kendaraans.kendaraanDetails.index', $kendaraan));
        }

        return view('kendaraan_details.edit')
              ->with('kendaraanDetail', $kendaraanDetail)
              ->with('kendaraans', $kendaraans)
              ->with('status', $this->status)
              ->with('kendaraan', $kendaraan)
              ->with('title', $title);
    }

    /**
     * Update the specified KendaraanDetail in storage.
     *
     * @param  int              $id
     * @param UpdateKendaraanDetailRequest $request
     *
     * @return Response
     */
    public function update(Kendaraan $kendaraan, $id, UpdateKendaraanDetailRequest $request)
    {
        $kendaraanDetail = $this->kendaraanDetailRepository->findWithoutFail($id);

        if (empty($kendaraanDetail)) {
            Flash::error('Kendaraan Detail not found');

            return redirect(route('kendaraans.kendaraanDetails.index', $kendaraan));
        }

        $kendaraanDetail = $this->kendaraanDetailRepository->update($request->all(), $id);

        Flash::success('Status Kendaraan updated successfully.');

        return redirect(route('kendaraans.kendaraanDetails.index', $kendaraan));
    }

    /**
     * Remove the specified KendaraanDetail from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy(Kendaraan $kendaraan, $id)
    {
        $kendaraanDetail = $this->kendaraanDetailRepository->findWithoutFail($id);

        if (empty($kendaraanDetail)) {
            Flash::error('Kendaraan Detail not found');

            return redirect(route('kendaraans.kendaraanDetails.index', $kendaraan));
        }

        $this->kendaraanDetailRepository->delete($id);

        Flash::success('Kendaraan Detail deleted successfully.');

        return redirect(route('kendaraans.kendaraanDetails.index', $kendaraan));
    }
}
