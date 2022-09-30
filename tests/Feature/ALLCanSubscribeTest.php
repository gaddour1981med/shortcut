<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ALLCanSubscribeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_all_can_subscribe()
    {
        $response = $this->get('/en/register');

        $response->assertStatus(200);
    }
}
