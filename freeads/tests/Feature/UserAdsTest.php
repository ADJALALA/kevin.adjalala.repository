<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserAdsTest extends TestCase
{
    /**
     * A basic test example.
     */

    use RefreshDatabase;

    public function test_authenticated_user_can_view_their_ads(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('ads.listeAds', $user->id));

        $response->assertStatus(200);
        $response->assertViewHas('userAds');
    }
}
