<?php

namespace App\Http\Controllers;

use App\Field;
use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriberFieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Subscriber $subscriber
     * @return \Illuminate\Http\Response
     */
    public function index(Subscriber $subscriber)
    {
        $fields = Field::with('type')->where('subscriber_id', '=', $subscriber->id)->get();
        return $fields;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Subscriber $subscriber, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'type_id' => ['required', 'exists:types,id'],
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $new_field = new Field();
        $new_field->title = $request->title;
        $new_field->type_id = $request->type_id;
        $new_field->subscriber_id = $subscriber->id;
        $new_field->save();
        return response($new_field->id, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Field $field
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber, Field $field)
    {
        return $field;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Field $field
     * @return \Illuminate\Http\Response
     */
    public function update(Subscriber $subscriber, Field $field)
    {
        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'type.id' => ['required', 'exists:types,id'],
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
        $field->update(request()->all());
        return response($field, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Field $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber, Field $field)
    {
        $field->delete();
        return response('', 204);
    }
}
