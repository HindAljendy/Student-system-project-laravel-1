<?php

namespace Database\Seeders;

use App\Models\BloodGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BloodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. empty the table for not duplicate the values . delete() / truncate()
        DB::table('blood_groups')->truncate();

        // 2. create in DB

        $blood_groups = ['A+','A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];

        foreach( $blood_groups as $blood){
            BloodGroup::create([
                'group_name' => $blood
            ]);
        }

    }
}
