<?php

namespace App\Repositories;

use App\Models\Pemesanan;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PemesananRepository
 * @package App\Repositories
 * @version November 26, 2017, 2:27 pm UTC
 *
 * @method Pemesanan findWithoutFail($id, $columns = ['*'])
 * @method Pemesanan find($id, $columns = ['*'])
 * @method Pemesanan first($columns = ['*'])
*/
class PemesananRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama_pemesanan',
        'tanggal_pesan',
        'lokasi',
        'contact_person'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pemesanan::class;
    }
}
