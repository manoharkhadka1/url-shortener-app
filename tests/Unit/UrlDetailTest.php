<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\UrlDetail;
use JWTAuth;

class UrlDetailTest extends TestCase
{
    use WithFaker;

    public function testGetAllUrlWithoutAuthentication()
    {
        $response = $this->json('GET', '/api/get-all-url');
        $response->assertStatus(401);
    }

    public function testGetAllUrlWithAuthentication()
    {
        $user = factory(\App\User::class)->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->json('GET', '/api/get-all-url?token='.$token);
        $response->assertStatus(200);
    }

    public function testDelete()
    {
        $user = factory(\App\User::class)->create();
        $token = JWTAuth::fromUser($user);
        $url = UrlDetail::first();
        if($url) {
            $delete = $this->json('DELETE', '/api/delete/'. $url->id.'?token='.$token);
            $delete->assertStatus(410);
        }

    }
}
