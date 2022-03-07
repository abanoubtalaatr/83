<?php

namespace Database\Seeders;

use App\Models\AdvertisingCampaign;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdvertisingCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdvertisingCampaign::factory()->count(10)->create();
    }
}
