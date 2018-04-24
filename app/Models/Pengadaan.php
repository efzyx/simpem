<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pengadaan
 * @package App\Models
 * @version March 2, 2018, 7:53 pm UTC
 *
 * @property integer bahan_baku_id
 * @property integer berat
 * @property string pemesanan_bahan_baku_id
 * @property string supir
 * @property string|\Carbon\Carbon tanggal_pengadaan
 * @property integer user_id
 * @property string keterangan
 */
class Pengadaan extends Model
{
    use SoftDeletes;

    public $table = 'pengadaans';


    protected $dates = ['deleted_at','tanggal_pengadaan'];


    public $fillable = [
        'bahan_baku_id',
        'berat',
        'pemesanan_bahan_baku_id',
        'supir',
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
        'pemesanan_bahan_baku_id' => 'integer',
        'supir' => 'string',
        'user_id' => 'integer',
        'keterangan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'berat' => 'required',
        'supir' => 'required',
        'pemesanan_bahan_baku_id' => 'required',
        'tanggal_pengadaan' => 'required',
    ];

    public function bahan_baku()
    {
        return $this->belongsTo('App\Models\BahanBaku');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function bahan_baku_histories()
    {
        return $this->hasMany(BahanBakuHistory::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::deleting(function (Pengadaan $pengadaan) {
            foreach ($pengadaan->bahan_baku_histories as $bahan_baku_history) {
                $bahan_baku_history->delete();
            }
        });
    }
    public function pemesanan_bahan_baku()
    {
        return $this->belongsTo('App\Models\PemesananBahanBaku');
    }
}
