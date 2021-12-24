<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matchtype;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Facades\Schema;

class MatchtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        // Add the master administrator, user id of 1
        $matchtypes = [
            [
                'type'        => '50-50',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'type'        => '20-20',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'type'        => '10-10',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            
        ];

        foreach ($matchtypes as $data) {
            $matchtype = Matchtype::create($data);
        }

        Schema::enableForeignKeyConstraints();
    }
}
