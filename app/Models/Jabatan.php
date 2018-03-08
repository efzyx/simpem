<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Jabatan
 * @package App\Models
 * @version March 2, 2018, 7:15 pm UTC
 *
 * @property string nama_jabatan
 * @property string keterangan
 */
class Jabatan extends Model
{
    use SoftDeletes;

    public $table = 'jabatans';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_jabatan',
        'keterangan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama_jabatan' => 'string',
        'keterangan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama_jabatan' => 'required'
    ];

    public function getJabatan($kode)
    {
      return $this->where('kode_jabatan', $kode)->first();
    }

    public function users()
    {
      $this->hasMany('App\User');
    }
}
