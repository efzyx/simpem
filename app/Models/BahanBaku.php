<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BahanBaku
 * @package App\Models
 * @version March 2, 2018, 7:49 pm UTC
 *
 * @property string nama_bahan_baku
 * @property string satuan
 */
class BahanBaku extends Model
{
    use SoftDeletes;

    public $table = 'bahan_bakus';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_bahan_baku',
        'satuan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama_bahan_baku' => 'string',
        'satuan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama_bahan_baku' => 'required',
        'satuan' => 'required'
    ];

    public static function getBahanBaku($kode)
    {
      return BahanBaku::where('kode', $kode)->first();
    }
}
