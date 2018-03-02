<?php

namespace App\Repositories;

use App\Models\Pengiriman;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PengirimanRepository
 * @package App\Repositories
 * @version March 2, 2018, 7:47 pm UTC
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
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pengiriman::class;
    }
}
