<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BatasPengadaan
 * @package App\Models
 * @version March 27, 2018, 2:09 pm WIB
 *
 * @property integer bahan_baku_id
 * @property integer maks_pengadaan
 */
class BatasPengadaan extends Model
{
    use SoftDeletes;

    public $table = 'batas_pengadaans';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'bahan_baku_id',
        'maks_pengadaan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'bahan_baku_id' => 'integer',
        'maks_pengadaan' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'bahan_baku_id' => 'required',
        'maks_pengadaan' => 'required'
    ];

    public function bahan_baku()
    {
        return $this->belongsTo(BahanBaku::class);
    }
}
