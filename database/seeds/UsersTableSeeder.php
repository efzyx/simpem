<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Jabatan;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      User::truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      $user = new User();
      $user->name = "Admin";
      $user->email = 'admin@admin.com';
      $user->password = bcrypt('secret');
      $user->remember_token = str_random(10);
      $user->save();
      $user->jabatan->associate(Jabatan::getJabatan('admin'));
    }
}
