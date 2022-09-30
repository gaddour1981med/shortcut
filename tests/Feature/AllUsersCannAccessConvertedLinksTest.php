<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Link;

class AllUsersCannAccessConvertedLinksTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_access_not_logged_user()
    {
        $link= Link::factory()->create();
        $response = $this->get('/'.$link->shortcut);
        $response->assertStatus(302);
       
    }


    public function test_access_logged_user()
    {
        $link= Link::factory()->create();
        $response= $this->actingAs($link->user)
                  ->withSession(['banned' => false])
                   ->get('/'.$link->shortcut);
        
        $response->assertStatus(302);
    }
}

