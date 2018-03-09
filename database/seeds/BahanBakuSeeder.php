<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\BahanBaku;

class BahanBakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bahan = [
          'semen' => ['Semen', 'Sak'],
          'air' => ['Air', 'm3'],
          'pasir' => ['Pasir', 'm3'],
          'split' => ['Split', 'ntah'],
          'addictive' => ['Addictive', 'ntah'],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        BahanBaku::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        foreach ($bahan as $key => $value) {
          $bahanBaku = new BahanBaku();
          $bahanBaku->kode = $key;
          $bahanBaku->nama_bahan_baku = $value[0];
          $bahanBaku->satuan = $value[1];
          $bahanBaku->save();
        }
    }
}
