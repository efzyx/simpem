<?php

use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatans = [
          'Marketing',
          'Produksi',
          'Logistik',
          'Manager Produksi'
        ];

        foreach ($jabatans as $key => $value) {
          $jabatan = new Jabatan();
          $jabatan->nama_jabatan = $value;
          $jabatan->save();
        }
    }
}
