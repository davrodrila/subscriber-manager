<?php

namespace Tests\Feature;

use Tests\SubscriberTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscribersEditTest extends SubscriberTestCase
{
    /*
     * PUT /subscribers/{subscribers} tests
     */
    public function testIfEditedUserReturnsOk()
    {
        $random_subscriber = \App\Subscriber::all()->random();
        $response = $this->put('/api/v1/subscribers/' . $random_subscriber->id);

        $response->assertStatus(200);
    }

}
