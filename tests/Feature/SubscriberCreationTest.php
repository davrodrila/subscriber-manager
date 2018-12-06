<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriberCreationTest extends TestCase
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

    public function testIfCreatedGivesProperResponse()
    {
        $this->populateSuscribers();

        $response = $this->post('/api/v1/subscribers/',[
            'name' => 'Pepe Perez',
            'email' => 'test@gmail.com',
        ]);

        $response->assertStatus(201);
    }

    public function testIfDefaultStateIsUnconfirmed()
    {


        $id = \DB::getPdo()->lastInsertId();
        $state = \App\State::getStateByName(State::$STATE_UNCONFIRMED);

        $response = $this->get('/api/v1/subscribers/' . $id);
        $response->assertJson(['state_id' => $state->id]);
    }

    public function testIfEmptyNameReturnsBadRequest()
    {
        $this->populateSuscribers();

        $response = $this->post('/api/v1/subscribers/',[
            'name' => '',
            'email' => 'test@gmail.com',
        ]);

        $response->assertStatus(400);
    }
}
