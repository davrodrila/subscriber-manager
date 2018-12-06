<?php

namespace Tests\Feature;

use App\State;
use Tests\SubscriberApiTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SuscribersApiApiTest extends SubscriberApiTestCase
{

    /*
     * GET /subscribers tests
     */
    public function testIfIndexReturnsOkWhenEmpty()
    {
        \Artisan::call('migrate:fresh'); //We make sure the database is empty
        $response = $this->get('/api/v1/subscribers');
        $response->assertStatus(200);
    }

    public function testIfDatabaseWithUsersReturnsOk()
    {
        $response = $this->get('/api/v1/subscribers');
        $response->assertStatus(200);
    }

    public function testIfItReturnsAllTheSubscribers()
    {
        $response = $this->get('/api/v1/subscribers');
        $response->assertJsonCount(20);
    }

    /*
     * GET /subscribers/{subscriber} tests
     */
    public function testIfNonExistentUserReturnsNotFound()
    {
        $last_subscriber = \App\Subscriber::all()->last();
        $response = $this->get('/api/v1/subscribers/' . ($last_subscriber->id+1));

        $response->assertStatus(404);
    }
    public function testIfExistingUserReturnsOk()
    {
        $random_subscriber = \App\Subscriber::all()->random();
        $response = $this->get('/api/v1/subscribers/' . $random_subscriber->id);
        $response->assertStatus(200);
    }


}
