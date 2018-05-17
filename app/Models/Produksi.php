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

    protected static function boot()
    {
        parent::boot();

        self::deleting(function (Produksi $produksi) {

            foreach ($produksi->bahan_baku_histories as $bahan_baku_history) {
                $bahan_baku_history->delete();
            }
        });
    }

    public $table = 'produksis';


    protected $dates = ['deleted_at', 'waktu_produksi'];


    public $fillable = [
        'nomor_dokumen',
        'nama_pengirim',
        'nama_penerima',
        'pemesanan_id',
        'volume',
        'waktu_produksi',
        'supir_id',
        'kendaraan_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nomor_dokumen' => 'string',
        'nama_pengirim' => 'string',
        'nama_penerima' => 'string',
        'pemesanan_id' => 'integer',
        'volume' => 'double',
        'supir_id' => 'integer',
        'kendaraan_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nomor_dokumen' => 'required|unique:produksis',
        'nama_pengirim' => 'required',
        'nama_penerima' => 'required',
        'pemesanan_id' => 'required',
        'volume' => 'required',
        'supir_id' => 'required',
        'kendaraan_id' => 'required'
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

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id', 'id');
    }

    public function bahan_baku_histories()
    {
        return $this->hasMany(BahanBakuHistory::class);
    }
}
