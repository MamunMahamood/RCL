<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trainer;

class TrainersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trainers = [
            [
                'trainer_name' => 'John Doe',
                'trainer_designation' => 'Senior Trainer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'trainer_name' => 'Jane Smith',
                'trainer_designation' => 'Technical Trainer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'trainer_name' => 'Alice Johnson',
                'trainer_designation' => 'Corporate Trainer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'trainer_name' => 'Bob Brown',
                'trainer_designation' => 'Soft Skills Trainer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'trainer_name' => 'Charlie Davis',
                'trainer_designation' => 'IT Trainer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Trainer::insert($trainers);
    }
}
