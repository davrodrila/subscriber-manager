<?php

namespace Tests\Feature;

use Tests\SubscriberTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriberDeleteTest extends SubscriberTestCase
{

    /*
     * DELETE /subscribers/{subscriber} tests
     * TODO: When the Field model is working, we will have to check for proper deletion
     */
    public function testIfDeletingUserReturnsNoContent()
    {
        $random_subscriber = \App\Subscriber::all()->random();
        $response = $this->delete('/api/v1/subscribers/' . $random_subscriber->id);

        $response->assertStatus(204);
    }
    public function testIfDeletedUserIsRemovedFromDatabase()
    {
        $random_subscriber = \App\Subscriber::all()->random();
        $this->delete('/api/v1/subscribers/' . $random_subscriber->id);
        $response = $this->get('/api/v1/subscribers/' . $random_subscriber->id);
        $response->assertStatus(404);
    }
}
