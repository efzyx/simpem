<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pengiriman
 * @package App\Models
 * @version March 2, 2018, 7:47 pm UTC
 *
 * @property integer produksi_id
 * @property integer status
 * @property integer user_id
 */
class Pengiriman extends Model
{
    use SoftDeletes;

    public $table = 'pengiriman';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'produksi_id',
        'status',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'produksi_id' => 'integer',
        'status' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'produksi_id' => 'required',
        'status' => 'required',
    ];
}
