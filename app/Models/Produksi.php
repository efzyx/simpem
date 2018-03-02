<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Produksi
 * @package App\Models
 * @version March 2, 2018, 7:44 pm UTC
 *
 * @property integer pemesanan_id
 * @property integer volume
 * @property integer semen
 * @property integer pasir
 * @property integer split
 * @property integer addictive
 * @property integer air
 * @property string|\Carbon\Carbon waktu_produksi
 * @property integer supir_id
 * @property string no_kendaraan
 * @property integer user_id
 */
class Produksi extends Model
{
    use SoftDeletes;

    public $table = 'produksis';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'pemesanan_id',
        'volume',
        'semen',
        'pasir',
        'split',
        'addictive',
        'air',
        'waktu_produksi',
        'supir_id',
        'no_kendaraan',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'pemesanan_id' => 'integer',
        'volume' => 'integer',
        'semen' => 'integer',
        'pasir' => 'integer',
        'split' => 'integer',
        'addictive' => 'integer',
        'air' => 'integer',
        'supir_id' => 'integer',
        'no_kendaraan' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'pemesanan_id' => 'required',
        'volume' => 'required',
        'supir_id' => 'required',
        'user_id' => 'required'
    ];
}
