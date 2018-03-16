<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class KendaraanDetail
 * @package App\Models
 * @version March 14, 2018, 9:43 pm WIB
 *
 * @property integer kendaraan_id
 * @property integer status
 * @property string|\Carbon\Carbon waktu
 */
class KendaraanDetail extends Model
{
    use SoftDeletes;

    public $table = 'kendaraan_details';


    protected $dates = ['deleted_at','waktu'];


    public $fillable = [
        'kendaraan_id',
        'status',
        'waktu'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'kendaraan_id' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'kendaraan_id' => 'required',
        'status' => 'required',
        'waktu' => 'required'
    ];

    public function kendaraan()
    {
        return $this->belongsTo('App\Models\Kendaraan');
    }
}
