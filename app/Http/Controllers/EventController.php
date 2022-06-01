<?php

namespace App\Http\Controllers;

use App\Mail\Events\Notification;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::paginate(5);
       return response($events, 200);
    }

    public function participate(Request $request){
        $data = $request->validate([
            'user_id'=>'required',
            'event_id'=>'required'
        ]);
        $user = User::find($data['user_id']);
        $event = Event::find($data['event_id']);
        if ($user AND $event) {
            $event->participants()->attach($user);
            Mail::to($user->email)->send(new Notification(
                [
                    'user'=>$user,
                    'event'=>$event
                ]
            ));
            return response('Subscription Validate', 201);
        }
        return response(['Error'=>'Subscription Error'], 401);
        
    }

    public function getParticipantes($id){
        $event = Event::find($id);
        $users = $event->participants()->get();
        return response($users, 200);
    }

    public function getAllEvents($id){
        $user = User::find($id);
        if ($user) {
            $events = $user->attendedEvents()->get();
            return response($events, 200);
        }
        return response(['error'=>'User not found'], 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}