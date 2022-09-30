<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

use function PHPUnit\Framework\assertTrue;

class AddLinkTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_connected_user_can_access()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
        ->withSession(['banned' => false])
        ->get('/en/home');

        $response->assertStatus(200);
    }

    public function test_not_connected_user_redirected(){

        $response = $this->get('/en/home');
 
        $response->assertStatus(302);
    }
}
