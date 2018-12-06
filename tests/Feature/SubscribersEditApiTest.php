<?php

namespace Tests\Feature;

use Tests\SubscriberApiTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscribersEditApiTest extends SubscriberApiTestCase
{
    /*
     * PUT /subscribers/{subscribers} tests
     */
    public function testIfEditedUserReturnsOk()
    {
        $random_subscriber = \App\Subscriber::all()->random();
        $response = $this->put('/api/v1/subscribers/' . $random_subscriber->id, [
            'name' => 'Pepe Perez',
            'email' => 'test@gmail.com',
        ]);

        $response->assertStatus(200);
    }

    public function testIfEditedNameIsSaved()
    {
        $random_subscriber = \App\Subscriber::all()->random();
        $response = $this->put('/api/v1/subscribers/' . $random_subscriber->id, [
            'name' => "Pepe Perez",
            'email' => 'test@gmail.com'
        ]);

        $response = $this->get('/api/v1/subscribers/' . $random_subscriber->id);
        $response->assertJson(['name' => 'Pepe Perez']);
    }

    public function testIfEditedEmailIsSaved()
    {
        $random_subscriber = \App\Subscriber::all()->random();
        $response = $this->put('/api/v1/subscribers/' . $random_subscriber->id, [
            'name' => $random_subscriber->name,
            'email' => "test@gmail.com",
        ]);

        $response = $this->get('/api/v1/subscribers/' . $random_subscriber->id);
        $response->assertJson(['email' => 'test@gmail.com']);
    }

    public function testIfEmptyNameIsSendShouldReturnBadRequest()
    {
        $random_subscriber = \App\Subscriber::all()->random();
        $response = $this->put('/api/v1/subscribers/' . $random_subscriber->id, [
            'name' => "",
            'email' => 'test@gmail.com',
        ]);
        $response->assertStatus(400);
    }
    public function testIfEmptyEmailIsSentShouldReturnBadRequest()
    {
        $random_subscriber = \App\Subscriber::all()->random();
        $response = $this->put('/api/v1/subscribers/' . $random_subscriber->id, [
            'name' => "Pepe Perez",
            'email' => '',
        ]);
        $response->assertStatus(400);
    }

    public function testIfEmailIsFilteringOwnIdOnUniqueness()
    {
        $random_subscriber = \App\Subscriber::all()->random();
        $response = $this->put('/api/v1/subscribers/' . $random_subscriber->id, [
            'name' => "Pepe Perez",
            'email' => 'test@gmail.com',
        ]);
        $response = $this->put('/api/v1/subscribers/' . $random_subscriber->id, [
            'name' => "Juan Perez",
            'email' => 'test@gmail.com',
        ]);
        $response->assertStatus(200);
    }
}
