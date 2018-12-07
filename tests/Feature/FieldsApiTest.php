<?php

namespace Tests\Feature;

use App\Field;
use App\Subscriber;
use App\Type;
use Tests\SubscriberApiTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FieldsApiTest extends SubscriberApiTestCase
{

    private $subscriber;

    public function setUp()
    {
        parent::setUp();
    }

    public function testIfIndexReturnsOk()
    {
        $subscriber = Field::all()->random()->subscriber;
        $response = $this->get('/api/v1/subscribers/' . $subscriber->id . '/fields');
        $response->assertStatus(200);
    }

    public function testIfIndexReturns404IfSubscriberDoesntExist()
    {
        $last_subscriber = Subscriber::all()->last();
        $response = $this->get('/api/v1/subscribers/' . ($last_subscriber->id + 1) . '/fields');
        $response->assertStatus(404);
    }

    public function testIfIndexReturnsProperNumberOfFields()
    {
        $subscriber = Field::all()->random()->subscriber;
        $count = $subscriber->fields()->count();
        $response = $this->get('/api/v1/subscribers/' . $subscriber->id  . '/fields');
        $response->assertJsonCount($count);
    }

    public function testIfShowReturnsOk()
    {
        $subscriber = Field::all()->random()->subscriber;
        $field = $subscriber->fields()->first();
        $response = $this->get('/api/v1/subscribers/' . $subscriber->id . '/fields/' . $field->id);
        $response->assertStatus(200);
    }

    public function testIfNonExistentFieldReturns404()
    {
        $last_subscriber = Subscriber::all()->last();
        $last_field = Field::all()->last();
        $response = $this->get('/api/v1/subscribers/' . ($last_subscriber->id) . '/fields/' . ($last_field->id+1));
        $response->assertStatus(404);
    }

    public function testIfShowReturnsExpectedValue()
    {
        $subscriber = Field::all()->random()->subscriber;
        $field = $subscriber->fields()->first();
        $response = $this->get('/api/v1/subscribers/' . $subscriber->id . '/fields/' . $field->id);

        $response->assertJson(['title' => $field->title]);
    }

    public function testIfCreateReturnsOk()
    {
        $subscriber = Field::all()->random()->subscriber;
        $type = Type::all()->random();
        $response = $this->post('/api/v1/subscribers/' . $subscriber->id . '/fields/', [
            'title' => 'Test title',
            'type' =>  $type,
        ]);
        $response->assertStatus(200);
    }

    public function testIfCreateIsPersisted()
    {
        $subscriber = Field::all()->random()->subscriber;
        $type = Type::all()->random();
        $this->post('/api/v1/subscribers/' . $subscriber->id . '/fields/', [
            'title' => 'Test title',
            'type' =>  $type,
        ]);
        $id = \DB::getPdo()->lastInsertId();
        $response = $this->get('/api/v1/subscribers/' . $subscriber->id . '/fields/' . $id);
        $response->assertStatus(200);
    }

    public function testIfNonExistentSubscriberReturnsNotAllowed()
    {
        $last_subscriber = Subscriber::all()->last();
        $type = Type::all()->random();
        $response = $this->delete('/api/v1/subscribers/' . ($last_subscriber->id+1) . '/fields/', [
            'title' => 'Test title',
            'type' =>  $type,
        ]);
        $response->assertStatus(405);
    }
    public function testIfNonExistentTypeReturnsBadRequest()
    {
        $subscriber = Field::all()->random()->subscriber;
        $type = new Type();
        $type->id = 9999;
        $type->title = 'Test';
        $response = $this->post('/api/v1/subscribers/' . $subscriber->id . '/fields/', [
            'title' => 'Test title',
            'type' =>  $type,
        ]);
        $response->assertStatus(400);
    }
    public function testIfEmptyTitleReturnsBadRequest()
    {
        $subscriber = Field::all()->random()->subscriber;
        $type = Type::all()->random();
        $response = $this->post('/api/v1/subscribers/' . $subscriber->id . '/fields/', [
            'title' => '',
            'type' =>  $type
        ]);
        $response->assertStatus(400);
    }

    public function testIfEmptyTypeReturnsBadRequest()
    {
        $subscriber = Field::all()->random()->subscriber;
        $response = $this->post('/api/v1/subscribers/' . $subscriber->id . '/fields/', [
            'title' => 'Test title',
            'type' =>  ''
        ]);
        $response->assertStatus(400);
    }

    public function testIfDeleteMethodReturnsNoContent()
    {
        $subscriber = Field::all()->random()->subscriber;
        $field = $subscriber->fields()->first();
        $response = $this->delete('/api/v1/subscribers/' . $subscriber->id . '/fields/' . $field->id);
        $response->assertStatus(204);
    }

    public function testIfDeleteMakesFieldReturnNotFound()
    {
        $subscriber = Field::all()->random()->subscriber;
        $field = $subscriber->fields()->first();
        $this->delete('/api/v1/subscribers/' . $subscriber->id . '/fields/' . $field->id);
        $response = $this->get('/api/v1/subscribers/' . $subscriber->id . '/fields/' . $field->id);
        $response->assertStatus(404);
    }

    public function testIfEditReturnsOk()
    {
        $subscriber = Field::all()->random()->subscriber;
        $field = $subscriber->fields()->first();
        $type = Type::all()->random();
        $response = $this->put('/api/v1/subscribers/' . $subscriber->id . '/fields/' . $field->id, [
            'title' => 'Test title',
            'type' => $type,
        ]);
        $response->assertStatus(200);
    }

    public function testIfEditMakesChangesOnTitle()
    {
        $subscriber = Field::all()->random()->subscriber;
        $field = $subscriber->fields()->first();
        $type = Type::all()->random();
        $this->put('/api/v1/subscribers/' . $subscriber->id . '/fields/' . $field->id, [
            'title' => 'Test title',
            'type' => $type,
        ]);

        $response = $this->get('/api/v1/subscribers/' . $subscriber->id . '/fields/' . $field->id);
        $response->assertJson(['title' =>'Test title']);
    }

    public function testIfEditWithEmptyTitleReturnsBadRequest()
    {
        $subscriber = Field::all()->random()->subscriber;
        $field = $subscriber->fields()->first();
        $type = Type::all()->random();
        $response = $this->put('/api/v1/subscribers/' . $subscriber->id . '/fields/' . $field->id, [
            'title' => '',
            'type' => $type,
        ]);
        $response->assertStatus(400);
    }

    public function testIfEditWithEmptyTypeReturnsBadRequest()
    {
        $subscriber = Field::all()->random()->subscriber;
        $field = $subscriber->fields()->first();
        $type = Type::all()->random();
        $response = $this->put('/api/v1/subscribers/' . $subscriber->id . '/fields/' . $field->id, [
            'title' => 'Test title',
            'type' => '',
        ]);
        $response->assertStatus(400);
    }
    public function testIfEditWithNonExistentTypeReturnsBadRequest()
    {
        $subscriber = Field::all()->random()->subscriber;
        $field = $subscriber->fields()->first();
        $type = new Type();
        $type->id = 9999;
        $type->title = 'Test';
        $response = $this->put('/api/v1/subscribers/' . $subscriber->id . '/fields/' . $field->id, [
            'title' => '',
            'type' => $type,
        ]);
        $response->assertStatus(400);
    }

}
