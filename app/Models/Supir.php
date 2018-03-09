<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Supir
 * @package App\Models
 * @version March 2, 2018, 7:23 pm UTC
 *
 * @property string no_supir
 * @property string nama_supir
 */
class Supir extends Model
{
    use SoftDeletes;

    public $table = 'supirs';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'no_supir',
        'nama_supir'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'no_supir' => 'string',
        'nama_supir' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'no_supir' => 'required|unique:supirs',
        'nama_supir' => 'required'
    ];
}
