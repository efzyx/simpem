<?php

namespace App\Repositories;

use App\Models\BatasPengadaan;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BatasPengadaanRepository
 * @package App\Repositories
 * @version March 27, 2018, 2:09 pm WIB
 *
 * @method BatasPengadaan findWithoutFail($id, $columns = ['*'])
 * @method BatasPengadaan find($id, $columns = ['*'])
 * @method BatasPengadaan first($columns = ['*'])
*/
class BatasPengadaanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'maks_pengadaan'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return BatasPengadaan::class;
    }
}
