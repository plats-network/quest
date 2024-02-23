<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use LevelUp\Experience\Models\Level;

//Run command: php artisan db:seed --class=LevelUpSeeder
class LevelUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
//        Level::add(
//            ['level' => 1, 'next_level_experience' => null],
//            ['level' => 2, 'next_level_experience' => 100],
//            ['level' => 3, 'next_level_experience' => 250],
//        );
        $LevelModel = Level::where('level', 1)->first();
        if (!is_null($LevelModel)) {
            return;
        }
        Level::add(
            ['level' => 1, 'next_level_experience' => null],
        );

        //For i = 2 to 100 then add level
        for ($i = 2; $i <= 100; $i++) {
            //Check if level exists
            $LevelModel = Level::where('level', $i)->first();
            if (!is_null($LevelModel)) {
                continue;
            }

            Level::add(['level' => $i, 'next_level_experience' => $i * 100]);
        }
    }
}
