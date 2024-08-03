<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            'name' => 'Cruzado',
            'lastname' => 'Gutierres',
            'dni' => '23435409',
            'phone' => '980908755',
            'cargo' => 'Instructor'
        ]);
    }
}
