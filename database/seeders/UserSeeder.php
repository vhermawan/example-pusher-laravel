<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [1, 'Admin', bcrypt('12345678'), 'Admin', 1, '08121222'],
            [2, 'Pemilik', bcrypt('12345678'), 'Pemilik', 1, '08121212'],
            [3, 'Peternak', bcrypt('12345678'), 'Peternak', 1, '0812122']
        ];

        for ($i=0; $i < count($data); $i++) {
            $id_role = $data[$i][0];
            $name = $data[$i][1];
            $password = $data[$i][2];
            $username = $data[$i][3];
            $status = $data[$i][4];
            $phone_number = $data[$i][5];
            $updated_at = Carbon::now();
            $created_at = Carbon::now();

            DB::table('users')->insert([
                'id_role' => $id_role,
                'name' => $name,
                'password' => $password,
                'username' => $username,
                'status' => $status,
                'phone_number' => $phone_number,
                'updated_at' => $updated_at,
                'created_at' => $created_at,
            ]);
        }
    }
}
