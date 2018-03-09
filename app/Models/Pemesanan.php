<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pemesanan
 * @package App\Models
 * @version March 2, 2018, 7:36 pm UTC
 *
 * @property string nama_pemesanan
 * @property integer produk_id
 * @property integer volume_pesanan
 * @property string|\Carbon\Carbon tanggal_pesanan
 * @property string|\Carbon\Carbon tanggal_kirim
 * @property string lokasi_proyek
 * @property integer jenis_pesanan
 * @property string cp_pesanan
 * @property integer user_id
 * @property string keterangan
 * @property integer status
 */
class Pemesanan extends Model
{
    use SoftDeletes;

    public $table = 'pemesanans';


    protected $dates = ['deleted_at', 'tanggal_pesanan', 'tanggal_kirim'];


    public $fillable = [
        'nama_pemesanan',
        'produk_id',
        'volume_pesanan',
        'tanggal_pesanan',
        'tanggal_kirim',
        'lokasi_proyek',
        'jenis_pesanan',
        'cp_pesanan',
        'user_id',
        'keterangan',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama_pemesanan' => 'string',
        'produk_id' => 'integer',
        'volume_pesanan' => 'integer',
        'lokasi_proyek' => 'string',
        'jenis_pesanan' => 'integer',
        'cp_pesanan' => 'string',
        'user_id' => 'integer',
        'keterangan' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama_pemesanan' => 'required',
        'produk_id' => 'required',
        'tanggal_pesanan' => 'required',
        'jenis_pesanan' => 'required',
    ];

    public function produk()
    {
        return $this->belongsTo('App\Models\Produk');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
