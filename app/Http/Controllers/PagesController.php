<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Http;

class PagesController extends Controller
{
    public function createPage(){
        $users = app('App\Http\Controllers\AuthController')->isAdmin(Session::get('token')->data->_id);

        if($users->role == 'patient'){
            if(Session::get('token') == null){
                return redirect()->route('login')->with('message', 'You must login first');
            }
    
            
            $response = Http::withHeaders([
                'Authorization' => Session::get('token')->token,
            ])->get('https://hospitalx-back.herokuapp.com/allAppointment');
    
            $responseBody = json_decode($response,true);
            $appointments =[];
    
            foreach($responseBody['data'] as $appointment){
                    array_push($appointments,$appointment);
            }
    
    
            $users = app('App\Http\Controllers\AuthController')->isAdmin(Session::get('token')->data->_id);
            

         return redirect()->route('home',compact('appointments','users'));
        }
        
        return view('createAppointment',compact('users'));
    }

    public function updatePage(Request $request){
        $users = app('App\Http\Controllers\AuthController')->isAdmin(Session::get('token')->data->_id);

        if($users->role == 'patient'){
            if(Session::get('token') == null){
                return redirect()->route('login')->with('message', 'You must login first');
            }
    
            
            $response = Http::withHeaders([
                'Authorization' => Session::get('token')->token,
            ])->get('https://hospitalx-back.herokuapp.com/allAppointment');
    
            $responseBody = json_decode($response,true);
            $appointments =[];
    
            foreach($responseBody['data'] as $appointment){
                    array_push($appointments,$appointment);
            }
    
    
            $users = app('App\Http\Controllers\AuthController')->isAdmin(Session::get('token')->data->_id);
            

         return redirect()->route('home',compact('appointments','users'));
        }

        $appointment = $request->appointment;
        
        return view('updateAppointment',compact('users','appointment'));
    }

    public function registrantPage(Request $request){
        $users = app('App\Http\Controllers\AuthController')->isAdmin(Session::get('token')->data->_id);

        if($users->role == 'patient'){
            if(Session::get('token') == null){
                return redirect()->route('login')->with('message', 'You must login first');
            }
    
            
            $response = Http::withHeaders([
                'Authorization' => Session::get('token')->token,
            ])->get('https://hospitalx-back.herokuapp.com/allAppointment');
    
            $responseBody = json_decode($response,true);
            $appointments =[];
    
            foreach($responseBody['data'] as $appointment){
                    array_push($appointments,$appointment);
            }
    
    
            $users = app('App\Http\Controllers\AuthController')->isAdmin(Session::get('token')->data->_id);


         return redirect()->route('home',compact('appointments','users'));
        }

        
        $id = $request->appointment['_id'];
        $appointment = $request->appointment;
        
        $response = Http::withHeaders([
            'Authorization' => Session::get('token')->token,
        ])->get('https://hospitalx-back.herokuapp.com/appointment/'.$id);

        $responseBody = json_decode($response,true);

        $registrants = $responseBody['data'];
        
        return view('seeRegistrant',compact('users','appointment','registrants'));
    }

}
