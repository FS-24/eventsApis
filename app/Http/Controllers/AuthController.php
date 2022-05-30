<?php

namespace App\Http\Controllers;

use App\Mail\Verification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    //

    public function register(Request $request){
        $credentials = $request->validate([
            'name'=>['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ]);
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        if ($user) {
            Mail::to($user->email)->send(new Verification([
                'user'=>$user,
                'url'=>route('email.verification',['id'=>$user->id])
            ]));
            return response([
                'user'=>$user,
                'token'=>$user->createToken('event_api')->plainTextToken
            ], 201);
        }
    }

    public function emailVerification($id){
        $user = User::find($id);
        $user->active = true;
        $user->email_verified_at = now();
        $user->save();
        return response('Votre compte a été bien activé', 201);
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            
            return response(['email' => 'The provided credentials are incorrect.'],404);
        }else if(!$user->active){
            return response(['email' => 'Your Account is not Activated'],400);
        }
        
        $response= [ 'user' =>$user,
                'token' =>$user->createToken('event_api')->plainTextToken
        ] ;
            return response($response, 201);
        
 
    }
    
}