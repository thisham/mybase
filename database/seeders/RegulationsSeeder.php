<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegulationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            DB::table('regulations')->insert([
                [
                    'id' => 'LOAN_FEE',
                    'rates' => 33.33
                ],
                [
                    'id' => 'INCOME_REDUCTION',
                    'rates' => 66.66
                ]
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
