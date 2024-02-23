<?php

namespace Database\Seeders;

use App\Models\ReferralProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use LevelUp\Experience\Models\Level;

//Run command: php artisan db:seed --class=LevelUpSeeder
class ReferralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $model = ReferralProgram::where('name', 'Sign-up Bonus')->first();
        if($model){
            dd('Referral Program already created');
        }
        $model = ReferralProgram::create(['name' => 'Sign-up Bonus', 'uri' => 'register']);

    }
}
