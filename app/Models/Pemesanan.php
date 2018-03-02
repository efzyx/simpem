<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pemesanan
 * @package App\Models
 * @version November 26, 2017, 2:27 pm UTC
 *
 * @property string nama_pemesanan
 * @property date tanggal_pesan
 * @property string lokasi
 * @property string contact_person
 */
class Pemesanan extends Model
{
    use SoftDeletes;

    public $table = 'pemesanans';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_pemesanan',
        'tanggal_pesan',
        'lokasi',
        'contact_person'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama_pemesanan' => 'string',
        'tanggal_pesan' => 'date',
        'lokasi' => 'string',
        'contact_person' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama_pemesanan' => 'required',
        'tanggal_pesan' => 'required'
    ];
}
