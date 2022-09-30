<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Link;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\assertTrue;

class MAXUserLinksTest extends TestCase
{
    use WithFaker;  // step two
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_add_before_max()
    {
        $user=User::factory()->create();
        Link::factory()->count(4)
                  ->create(["user_id"=>$user->id]);         

        $this->actingAs($user)
                  ->withSession(['banned' => false])
                  ->post('/en/links/add/save',['_token'=>Session::token(),'url'=>"https://google.fr"]);

       
        $count=Link::where("user_id",$user->id)->count();
        assertTrue($count==5);
    }

    public function test_user_can_not_add_after_max()
    {
        $user=User::factory()->create();
        Link::factory()->count(5)
                  ->create(["user_id"=>$user->id]);         

        $this->actingAs($user)
                  ->withSession(['banned' => false])
                  ->post('/en/links/add/save',['_token'=>Session::token(),'url'=>$this->faker()->url()]);

       
        $count=Link::where("user_id",$user->id)->count();
        assertTrue($count==5);
    }
}
