<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Link;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class MAXDBLinksTest extends TestCase
{
    use WithFaker;  // step two
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_always_max_links_in_DB()
    {
        Link::factory()->count(20)->create();        
        $user=User::factory()->create();
        $this->actingAs($user)
                  ->withSession(['banned' => false])
                  ->post('/en/links/add/save',['_token'=>Session::token(),'url'=>'https://google.fr']);
        $this->assertDatabaseCount("links",20);

    }
}
