<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SuscribersApiTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        \Artisan::call('migrate:refresh');
    }

    public function populateSuscribers()
    {
        \Artisan::call('db:seed');
    }

    /*
     * GET /subscribers tests
     */
    public function testIfIndexReturnsOkWhenEmpty()
    {
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
        $this->populateSuscribers();
        $response = $this->get('/api/v1/subscribers');

        $response->assertJsonCount(20);
    }

    /*
     * GET /subscribers/{subscriber} tests
     */
    public function testIfNonExistentUserReturnsNotFound()
    {
        $response = $this->get('/api/v1/subscribers/1');

        $response->assertStatus(404);
    }
    public function testIfExistingUserReturnsOk()
    {
        $this->populateSuscribers();
        $random_subscriber = \App\Subscriber::all()->random();
        $response = $this->get('/api/v1/subscribers/' . $random_subscriber->id);

        $response->assertStatus(200);
    }



}
