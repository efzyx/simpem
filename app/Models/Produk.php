<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Produk
 * @package App\Models
 * @version November 26, 2017, 2:23 pm UTC
 *
 * @property string nama_produk
 * @property int harga_satuan
 */
class Produk extends Model
{
    use SoftDeletes;

    public $table = 'produks';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_produk',
        'harga_satuan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama_produk' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama_produk' => 'required',
        'harga_satuan' => 'required'
    ];
}
