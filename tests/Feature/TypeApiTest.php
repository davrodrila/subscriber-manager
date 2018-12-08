<?php

namespace Tests\Feature;

use App\Type;
use Tests\SubscriberApiTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TypeApiTest extends SubscriberApiTestCase
{

    public function testIfIndexReturnsOk()
    {
        $response = $this->get('/api/v1/types');
        $response->assertStatus(200);
    }

    public function testIfIndexReturnsProperNumberOfTypes()
    {
        $types= Type::all();
        $response = $this->get('/api/v1/types');
        $response->assertJsonCount($types->count());
    }
}
