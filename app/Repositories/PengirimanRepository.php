<?php

namespace App\Repositories;

use App\Models\Pengiriman;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PengirimanRepository
 * @package App\Repositories
 * @version March 9, 2018, 3:55 am WIB
 *
 * @method Pengiriman findWithoutFail($id, $columns = ['*'])
 * @method Pengiriman find($id, $columns = ['*'])
 * @method Pengiriman first($columns = ['*'])
*/
class PengirimanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'produksi_id',
        'status',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pengiriman::class;
    }
}
