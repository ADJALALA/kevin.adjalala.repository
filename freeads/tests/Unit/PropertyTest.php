<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_on_display(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
}
