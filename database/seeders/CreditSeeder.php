<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('credits')->insert([
            "user_id" => $this->getSuperAdmin(),
            "parent_id"=> $this->getSuperAdmin(),
            "points" => "100000",
            "type" => "credit",
            "net_points" => "100000",
            "action_id" => $this->getSuperAdmin(),
            'created_at' => now(),
            'updated_at' => now()  
        ]);
    }

    private function getSuperAdmin() {
        $user = DB::table('users')->where('name','Super Admin')->first();
        return $user->id;
    }
}
