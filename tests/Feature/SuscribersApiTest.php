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

    public function testIfIndexReturnsOkWhenEmpty()
    {
        $response = $this->get('/api/v1/subscribers');

        $response->assertStatus(200);
    }
}
