<?php

namespace Tests\Feature;

use Tests\SubscriberTestCase;
use Tests\TestCase;
use App\State;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriberCreationTest extends SubscriberTestCase
{

    public function testIfCreatedGivesProperResponse()
    {
        $response = $this->post('/api/v1/subscribers/', [
            'name' => 'Pepe Perez',
            'email' => 'test@gmail.com',
        ]);

        $response->assertStatus(201);
    }

    public function testIfDefaultStateIsUnconfirmed()
    {
        $response = $this->post('/api/v1/subscribers/', [
            'name' => 'Pepe Perez',
            'email' => 'test@gmail.com',
        ]);
        $id = \DB::getPdo()->lastInsertId();
        $state = \App\State::getStateByName(State::$STATE_UNCONFIRMED);

        $response = $this->get('/api/v1/subscribers/' . $id);
        $response->assertJson(['state_id' => $state->id]);
    }

    public function testIfEmptyNameReturnsBadRequest()
    {
        $response = $this->post('/api/v1/subscribers/', [
            'name' => '',
            'email' => 'test@gmail.com',
        ]);

        $response->assertStatus(400);
    }

    public function testIfEmptyEmailReturnsBadRequest()
    {
        $response = $this->post('/api/v1/subscribers/', [
            'name' => 'Pepe Perez',
            'email' => '',
        ]);

        $response->assertStatus(400);
    }

    public function testIfEmailIsNotUnique()
    {
        $random_subscriber = \App\Subscriber::all()->random();
        $response = $this->post('/api/v1/subscribers/', [
            'name' => 'Pedro Jimenez',
            'email' => $random_subscriber->email,
        ]);
        $response->assertStatus(400);
    }

    public function testIfInvalidEmailReturnsBadRequest()
    {
        $response = $this->post('/api/v1/subscribers/', [
           'name' => 'Pedro Pepe',
           'email' => 'invalid',
        ]);
        $response->assertStatus(400);
    }

    public function testIfInactiveDomainOnEmailReturnsBadRequest()
    {
        $response = $this->post('/api/v1/subscribers/', [
            'name' => 'Pedro Pepe',
            'email' => 'test@example.net',
        ]);
        $response->assertStatus(400);
    }
}

