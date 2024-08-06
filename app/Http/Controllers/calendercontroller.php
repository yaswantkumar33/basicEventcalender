<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class calendercontroller extends Controller
{
    public function index(Request $request)
    {
        if(auth()->user()){
            if($request->ajax()){
                $data = Events::whereDate('StartTime', '>=', $request->start)
                          ->whereDate('EndTime', '<=', $request->end)
                          ->where('UserId','=',auth()->user()->id)
                          ->get(['id', 'title', 'StartTime as start', 'description','EndTime as end']);
                return response()->json($data);
            }
            return view('calender');
        }else{
            return redirect('/login');
        }
    }
    public function login(){
        return view('login');
    }
    public function register(){
        return view('register');
    }
    public function userauth(Request $request){
       if($request->type =="register"){
        $user = User::create([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'password'=>$request->password,
             ]);
        return response()->json($user);
       }else if($request->type == "login"){
        $user = User::where('email', $request->email)->first();

        if ($user && $user->password === $request->password) {
            Auth::login($user);
            return response()->json([
                'message' => 'Login successful',
                'redirect_url' => "/login"
            ]);
        } else {
            return response()->json([
                'error' => 'Invalid credentials. Please try again.'
            ], 401);
        }
       }
    }
    public function action(Request $request){
        if($request->ajax()){
            if($request->type=='add'){
                $event = Events::create([
               'title'=>$request->title,
               'StartTime'=>$request->start,
               'EndTime'=>$request->end,
               'description'=>$request->description,
               'UserId'=>auth()->user()->id,
                ]);
                return response()->json($event);
            }else if($request->type=="update"){
                $event = Events::where('id', $request->id)
                ->update(['title' => $request->title,'StartTime'=>$request->start,'EndTime'=>$request->end]);
                return response()->json($event);

            }else if($request->type=="delete"){
                $event =Events::where('id',$request->id)->delete();
                return response()->json($event);

            }
        }
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}