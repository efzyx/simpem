<?php

use Illuminate\Database\Seeder;
use App\Models\Jabatan;
use Illuminate\Support\Facades\DB;
use App\Models\BahanBaku;
use App\User;
use App\Models\Produk;
use App\Models\Supir;

class TruncateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        switch (env('DB_CONNECTION')) {
          case 'mysql':
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Jabatan::truncate();
            User::truncate();
            BahanBaku::truncate();
            Produk::truncate();
            Supir::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            break;
          case 'pgsql':
            DB::statement('TRUNCATE jabatans CASCADE');
            DB::statement('TRUNCATE users CASCADE');
            DB::statement('TRUNCATE bahan_bakus CASCADE');
            DB::statement('TRUNCATE produks CASCADE');
            DB::statement('TRUNCATE supirs CASCADE');
            break;
          default:
            # code...
            break;
        }
    }
}
