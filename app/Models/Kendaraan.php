<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Kendaraan
 * @package App\Models
 * @version March 14, 2018, 9:08 pm WIB
 *
 * @property string jenis_kendaraan
 * @property string no_polisi
 */
class Kendaraan extends Model
{
    use SoftDeletes;

    public $table = 'kendaraans';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'jenis_kendaraan',
        'no_polisi'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'jenis_kendaraan' => 'string',
        'no_polisi' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'jenis_kendaraan' => 'required',
        'no_polisi' => 'required'
    ];
}
