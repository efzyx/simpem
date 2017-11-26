<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPemesanan extends Model
{
    public $table = 'detail_pemesanan';

    public $fillable = [
        'pemesanan_id',
        'produk_id',
        'quantity'
    ];

    protected $casts = [
        'pemesanan_id' => 'integer',
        'produk_id' => 'integer',
        'quantity' => 'integer'
    ];
}
