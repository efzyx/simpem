<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Produk;
use App\Models\BahanBaku;

class CreateProdukRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Produk::$rules;
        $bahan_bakus = BahanBaku::pluck('nama_bahan_baku');
        foreach ($bahan_bakus as $key => $bahan_baku) {
            $bahan_baku = str_replace(' ', '_', strtolower($bahan_baku));
            $rules[$bahan_baku] = 'required';
        }
        return $rules;
    }
}
