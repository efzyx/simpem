<?php

namespace App\Repositories;

use App\Models\Produk;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProdukRepository
 * @package App\Repositories
 * @version November 26, 2017, 2:23 pm UTC
 *
 * @method Produk findWithoutFail($id, $columns = ['*'])
 * @method Produk find($id, $columns = ['*'])
 * @method Produk first($columns = ['*'])
*/
class ProdukRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama_produk',
        'harga_satuan'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Produk::class;
    }
}
