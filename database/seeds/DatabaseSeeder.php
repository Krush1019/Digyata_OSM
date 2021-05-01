<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // $this->call(UsersTableSeeder::class);
        // $this->createAdmin();
    }

    private function createAdmin() {
        $arr = array(
            'name' => 'Rashmin',
            'email' => 'rp@gmail.com',
            'password' => Hash::make("rp@gmail.com")
        );
        User::create($arr);
    }
}
