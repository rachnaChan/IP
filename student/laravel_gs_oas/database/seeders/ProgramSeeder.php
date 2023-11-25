<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Program::create([
            'name' => 'Master of Materials and Structure Engineering',
            'head_of_program_id' => 5,
        ]);

        Program::create([
            'name' => 'Master of Water and Environmental Engineering',
            'head_of_program_id' => 3,
        ]);

        Program::create([
            'name' => 'Master of Agro-Industrial Engineering',
            'head_of_program_id' => 4,
        ]);

        Program::create([
            'name' => 'Master of Computer Science',
            'head_of_program_id' => 2,
        ]);

        Program::create([
            'name' => 'Master of Data Science',
            'head_of_program_id' => 6,
        ]);

        Program::create([
            'name' => 'Master of Mechatronics, Information and Communication Engineering',
            'head_of_program_id' => 7,
        ]);

        Program::create([
            'name' => 'Master of Transport Engineering',
            'head_of_program_id' => 8,
        ]);

        Program::create([
            'name' => 'Master of Energy Technology and Management Engineering',
            'head_of_program_id' => 9,
        ]);
    }
}

