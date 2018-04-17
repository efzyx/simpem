<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class pemesanan_bahan_baku
 * @package App\Models
 * @version April 16, 2018, 1:57 pm WIB
 *
 * @property string nama_supplier
 * @property integer cp_supplier
 * @property integer bahan_baku_id
 * @property integer volume_pemesanan
 * @property date tanggal_pemesanan
 * @property string keterangan
 */
class pemesanan_bahan_baku extends Model
{
    use SoftDeletes;

    public $table = 'pemesanan_bahan_bakus';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_supplier',
        'cp_supplier',
        'bahan_baku_id',
        'volume_pemesanan',
        'tanggal_pemesanan',
        'keterangan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama_supplier' => 'string',
        'cp_supplier' => 'integer',
        'bahan_baku_id' => 'integer',
        'volume_pemesanan' => 'integer',
        'tanggal_pemesanan' => 'date',
        'keterangan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama_supplier' => 'required',
        'cp_supplier' => 'required',
        'bahan_baku_id' => 'required',
        'volume_pemesanan' => 'required',
        'tanggal_pemesanan' => 'required',
        'keterangan' => 'required'
    ];

    public function bahan_baku()
    {
        return $this->belongsTo('App\Models\BahanBaku');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pengadaan()
    {
        return $this->hasMany('App\Model\Pengadaan');
    }
}
