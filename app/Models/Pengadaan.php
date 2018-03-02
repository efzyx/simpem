<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pengadaan
 * @package App\Models
 * @version March 2, 2018, 7:53 pm UTC
 *
 * @property integer bahan_baku_id
 * @property integer berat
 * @property string supplier
 * @property string|\Carbon\Carbon tanggal_pengadaan
 * @property integer user_id
 * @property string keterangan
 */
class Pengadaan extends Model
{
    use SoftDeletes;

    public $table = 'pengadaans';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'bahan_baku_id',
        'berat',
        'supplier',
        'tanggal_pengadaan',
        'user_id',
        'keterangan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'bahan_baku_id' => 'integer',
        'berat' => 'integer',
        'supplier' => 'string',
        'user_id' => 'integer',
        'keterangan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'bahan_baku_id' => 'required',
        'berat' => 'required',
        'supplier' => 'required',
        'tanggal_pengadaan' => 'required',
        'user_id' => 'required'
    ];
}
