<?php

use Illuminate\Database\Seeder;
use App\Models\Jabatan;
use Illuminate\Support\Facades\DB;

class TruncateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table_names = [];
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            foreach ($table as $key => $value) {
                $table_names[] = $value;
            }
        }
        switch (env('DB_CONNECTION')) {
          case 'mysql':
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            foreach ($table_names as $key => $value) {
                DB::statement('TRUNCATE TABLE '.$value);
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            break;
          case 'pgsql':
            foreach ($table_names as $key => $value) {
                DB::statement('TRUNCATE '.$value.' CASCADE');
            }
            break;
          default:
            # code...
            break;
        }
    }
}
