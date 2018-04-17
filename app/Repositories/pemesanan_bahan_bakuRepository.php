<?php

namespace App\Repositories;

use App\Models\pemesanan_bahan_baku;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class pemesanan_bahan_bakuRepository
 * @package App\Repositories
 * @version April 16, 2018, 1:57 pm WIB
 *
 * @method pemesanan_bahan_baku findWithoutFail($id, $columns = ['*'])
 * @method pemesanan_bahan_baku find($id, $columns = ['*'])
 * @method pemesanan_bahan_baku first($columns = ['*'])
*/
class pemesanan_bahan_bakuRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama_supplier',
        'cp_supplier',
        'bahan_baku_id',
        'volume_pemesanan',
        'tanggal_pemesanan',
        'keterangan'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return pemesanan_bahan_baku::class;
    }
}
