<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Produk
 * @package App\Models
 * @version March 2, 2018, 7:13 pm UTC
 *
 * @property string mutu_produk
 * @property string satuan
 */
class Produk extends Model
{
    use SoftDeletes;

    public $table = 'produks';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'mutu_produk',
        'satuan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'mutu_produk' => 'string',
        'satuan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'mutu_produk' => 'required',
        'satuan' => 'required'
    ];
}
