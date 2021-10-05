<?php

//panggil model
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // panggil nama function
        $this->user();
    }

    public function user() /**ini nama function.e, menyesuaikan aja */
    {
        $payload = [
            'name' => 'admin',
            'email' => 'andrenuryana@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '0823239323423',
            'role' => 'admin',
            'jenis_kelamin' => 'perempuan',
        ];

        User::firstOrCreate($payload)->sharedLock()->get();

        $payload = [
            'name' => 'admin_sifana',
            'email' => 'sipahna123@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '0823239323423',
            'role' => 'admin',
            'jenis_kelamin' => 'perempuan',
        ];

        User::firstOrCreate($payload)->sharedLock()->get();

        $payload = [
            'name' => 'pemilik sifana',
            'email' => 'arinilkh123@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '0823239323423',
            'role' => 'admin',
            'jenis_kelamin' => 'perempuan',
        ];

        User::firstOrCreate($payload)->sharedLock()->get();

        $payload = [
            'name' => 'user pemilik',
            'email' => 'ilyasyusuf023@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '087567786734',
            'role' => 'pemilik',
            'jenis_kelamin' => 'laki-laki',
        ];

        User::firstOrCreate($payload);

        $payload = [
            'name' => 'user',
            'email' => 'ilyasyusuf019@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '087567786734',
            'role' => 'pelanggan',
            'jenis_kelamin' => 'laki-laki',
        ];

        User::firstOrCreate($payload);

    }
}
