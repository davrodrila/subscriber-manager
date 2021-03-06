<?php

namespace App\Http\Controllers;

use App\Rules\EmailDomain;
use App\State;
use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PharIo\Manifest\Email;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = Subscriber::with('state')->get();
        return $subscribers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:subscribers', new EmailDomain()]
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
        $new_subscriber = new Subscriber();
        $new_subscriber->name = $request->name;
        $new_subscriber->email = $request->email;
        $new_subscriber->state_id = State::getStateByName(State::$STATE_UNCONFIRMED)->id;
        $new_subscriber->save();

        return response(['id' => $new_subscriber->id], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscriber $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber)
    {
        $subscriber = Subscriber::with('state', 'fields')->where('id', '=', $subscriber->id)->first();
        return $subscriber;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Subscriber $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:subscribers,' . $subscriber->id, new EmailDomain()]
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $subscriber->update($request->all());
        return response(['id' => $subscriber->id], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscriber $subscriber
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->fields()->delete();
        $subscriber->delete();
        return response('', 204);
    }
}
