<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new User();
      $user->name = "Admin";
      $user->email = 'admin@admin.com';
      $user->password = bcrypt('secret');
      $user->jabatan_id = 1;
      $user->remember_token = str_random(10);
      $user->save();
    }
}
