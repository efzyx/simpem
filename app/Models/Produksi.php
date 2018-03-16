<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Produksi
 * @package App\Models
 * @version March 2, 2018, 7:44 pm UTC
 *
 * @property integer pemesanan_id
 * @property integer volume
 * @property string|\Carbon\Carbon waktu_produksi
 * @property integer supir_id
 * @property string no_kendaraan
 * @property integer user_id
 */
class Produksi extends Model
{
    use SoftDeletes;

    public $table = 'produksis';


    protected $dates = ['deleted_at', 'waktu_produksi'];


    public $fillable = [
        'pemesanan_id',
        'volume',
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
        'supir_id' => 'integer',
        'no_kendaraan' => 'string'
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
    ];

    public function pemesanan()
    {
        return $this->belongsTo('App\Models\Pemesanan');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function supir()
    {
        return $this->belongsTo('App\Models\Supir');
    }

    public function pengiriman()
    {
        return $this->hasOne('App\Models\pengiriman');
    }
}
