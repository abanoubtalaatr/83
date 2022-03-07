<?php

namespace AdvertisingCampaign;

use App\Models\AdvertisingCampaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdvertisingCampaignTest extends TestCase
{
    use RefreshDatabase;

    /***
      Index Method
     ***/

    public function test__user_list_all_advertising_campaigns()
    {
        $advertisingCampaigns = AdvertisingCampaign::factory()->count(10)->create();

        $this->json('get', route('advertising-campaigns.index'))
            ->assertSuccessful();

        $this->assertDatabaseCount('advertising_campaigns', 10);

    }

    /*
     * Show Method
     */

    public function test_user_can_show_specific_advertising_campaign()
    {
        $data = AdvertisingCampaign::factory()->create();

        $this->json('get', route('advertising-campaigns.show', $data))
            ->assertSuccessful()
            ->assertJsonFragment($data->jsonSerialize());

        $this->assertDatabaseHas('advertising_campaigns', [
            'name' => $data['name']
        ]);
    }

    /*
     * Store Method
     */

    public function test_user_can_store_new_advertising_campaign()
    {
        Storage::fake();

        $data = AdvertisingCampaign::factory()->raw();

        $this->json('post', route('advertising-campaigns.store'), $data)
            ->assertSuccessful();

        $this->assertDatabaseHas('advertising_campaigns', [
            'name' => $data['name']
        ]);
    }

    public function test_user_can_not_store_new_advertising_campaign_without_name_field()
    {
        $data = AdvertisingCampaign::factory()->raw();
        unset($data['name']);

        $this->json('post', route('advertising-campaigns.store'), $data)
            ->assertJsonValidationErrors('name');
    }

    public function test_user_can_not_store_new_advertising_campaign_without_from_field()
    {
        $data = AdvertisingCampaign::factory()->raw();
        unset($data['from']);

        $this->json('post', route('advertising-campaigns.store'), $data)
            ->assertJsonValidationErrors('from');
    }

    public function test_user_can_not_store_new_advertising_campaign_without_to_field()
    {
        $data = AdvertisingCampaign::factory()->raw();
        unset($data['to']);

        $this->json('post', route('advertising-campaigns.store'), $data)
            ->assertJsonValidationErrors('to');
    }

    public function test_user_can_not_store_new_advertising_campaign_without_total_field()
    {
        $data = AdvertisingCampaign::factory()->raw();
        unset($data['total']);

        $this->json('post', route('advertising-campaigns.store'), $data)
            ->assertJsonValidationErrors('total');
    }

    public function test_user_can_not_store_new_advertising_campaign_without_daily_budget_field()
    {
        $data = AdvertisingCampaign::factory()->raw();
        unset($data['daily_budget']);

        $this->json('post', route('advertising-campaigns.store'), $data)
            ->assertJsonValidationErrors('daily_budget');
    }

    /*
     * Update Method
     */

    public function test_user_can_update_advertising_campaign()
    {
        $advertising = AdvertisingCampaign::factory()->create();
        $data = AdvertisingCampaign::factory()->raw();

        $this->json('put', route('advertising-campaigns.update', $advertising), $data)
            ->assertSuccessful();

        $this->assertDatabaseHas('advertising_campaigns', [
            'name' => $data['name']
        ]);
    }

    public function test_user_can_not_update_advertising_campaign_without_name_field()
    {
        $advertising = AdvertisingCampaign::factory()->create();
        $data = AdvertisingCampaign::factory()->raw();
        unset($data['name']);

        $this->json('put', route('advertising-campaigns.update', $advertising), $data)
            ->assertJsonValidationErrors('name');
    }

    public function test_user_can_not_update_advertising_campaign_without_from_field()
    {
        $advertising = AdvertisingCampaign::factory()->create();
        $data = AdvertisingCampaign::factory()->raw();
        unset($data['from']);

        $this->json('put', route('advertising-campaigns.update', $advertising), $data)
            ->assertJsonValidationErrors('from');
    }


    public function test_user_can_not_update_advertising_campaign_without_to_field()
    {
        $advertising = AdvertisingCampaign::factory()->create();
        $data = AdvertisingCampaign::factory()->raw();
        unset($data['to']);

        $this->json('put', route('advertising-campaigns.update', $advertising), $data)
            ->assertJsonValidationErrors('to');
    }

    public function test_user_can_not_update_advertising_campaign_without_total_field()
    {
        $advertising = AdvertisingCampaign::factory()->create();
        $data = AdvertisingCampaign::factory()->raw();
        unset($data['total']);

        $this->json('put', route('advertising-campaigns.update', $advertising), $data)
            ->assertJsonValidationErrors('total');
    }

    public function test_user_can_not_update_advertising_campaign_without_daily_budget_field()
    {
        $advertising = AdvertisingCampaign::factory()->create();
        $data = AdvertisingCampaign::factory()->raw();
        unset($data['daily_budget']);

        $this->json('put', route('advertising-campaigns.update', $advertising), $data)
            ->assertJsonValidationErrors('daily_budget');
    }

    /*
     * Delete Method
     */
    public function test_user_can_delete_advertising_campaigns()
    {
        $data = AdvertisingCampaign::factory()->create();

        $this->json('delete', route('advertising-campaigns.destroy', $data->id))
            ->assertSuccessful()
            ->assertJsonFragment(['message' => 'Advertising Campaign deleted successfully.']);
    }
}
