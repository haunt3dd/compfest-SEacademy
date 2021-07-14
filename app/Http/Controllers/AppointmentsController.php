<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Genre;
use App\Episode;
use Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index()
    {
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

        return view('index',compact('appointments','users'));
        // return view('index');
    }


    public function createAppointment(Request $request){
        if(Session::get('token') == null){
            return redirect()->route('login')->with('message', 'You must login first');
        }

        if($request->not_full == '1' || $request->not_full == 'on'){
            $status = 'Not Full';
        }else if($request->full == '1'|| $request->full == 'on'){
            $status = 'Full';
        }


        $response =  Http::withHeaders([
            'Authorization' => Session::get('token')->token,
        ])->post('https://hospitalx-back.herokuapp.com/appointment',[
            'doctorName' => $request->doctorName,
            'Description' => $request->Description,
            'Status' => $status
        ]);

        
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


    public function login(){
        return view('loginRegister');
    }

    public function applyRegistrant($username,$id){
        $response =  Http::withHeaders([
            'Authorization' => Session::get('token')->token,
        ])->post('https://hospitalx-back.herokuapp.com/addRegistrant',[
            'AppointmentID' => $id,
            'Registrant' => $username
        ]);


        $users = app('App\Http\Controllers\AuthController')->isAdmin(Session::get('token')->data->_id);

        $responseBody = json_decode($response->body());

        return redirect()->route('home',compact('users'));
    }

    public function cancelAppointment($username,$id){
        $response =  Http::withHeaders([
            'Authorization' => Session::get('token')->token,
        ])->delete('https://hospitalx-back.herokuapp.com/appointment/cancelAppointment',[
            'AppointmentID' => $id,
            'Registrant' => $username
        ]);

        $responseBody = json_decode($response->body());

        $users = app('App\Http\Controllers\AuthController')->isAdmin(Session::get('token')->data->_id);

        return redirect()->route('home',compact('users'));
    }

    public function myAppointment(Request $request){
        if(Session::get('token') == null){
            return redirect()->route('login')->with('message', 'You must login first');
        }


        $response = Http::withHeaders([
            'Authorization' => Session::get('token')->token,
        ])->get('https://hospitalx-back.herokuapp.com/myAppointment/'. Session::get('token')->data->username);

        $responseBody = json_decode($response,true);
        $appointment =[];

        foreach($responseBody['data'] as $myAppointment){
                array_push($appointment,$myAppointment);
        }

        
        $appointments = [];
        foreach($appointment as $a){
            $res = Http::withHeaders([
                'Authorization' => Session::get('token')->token,
            ])->get('https://hospitalx-back.herokuapp.com/appointment/find/' .$a['AppointmentID']);

            $resBody = json_decode($res,true);
            array_push($appointments,$resBody['data']);
        }


        $users = app('App\Http\Controllers\AuthController')->isAdmin(Session::get('token')->data->_id);

        

        return view('index',compact('appointments','users'));
    }

    public function deleteAppointment(Request $request){
        if(Session::get('token') == null){
            return redirect()->route('login')->with('message', 'You must login first');
        }

        $response =  Http::withHeaders([
            'Authorization' => Session::get('token')->token,
        ])->delete('https://hospitalx-back.herokuapp.com/appointment/delete/'.$request->id);

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

    public function updateAppointment(Request $request){
        if(Session::get('token') == null){
            return redirect()->route('login')->with('message', 'You must login first');
        }
        if($request->not_full == '1' || $request->not_full == 'on'){
            $status = 'Not Full';
        }else if($request->full == '1'|| $request->full == 'on'){
            $status = 'Full';
        }

        $response =  Http::withHeaders([
            'Authorization' => Session::get('token')->token,
        ])->put('https://hospitalx-back.herokuapp.com/appointment/update/'.$request->id,[
            'doctorName' => $request->doctorName,
            'Description' => $request->Description,
            'Status' => $status
        ]);

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

    
    public function detail($id)
    {
        
        if(Session::get('token') == null){
            return redirect()->route('login')->with('message', 'You must login first');
        }

        $response = Http::withHeaders([
            'Authorization' => Session::get('token')->token,
        ])->get('https://hospitalx-back.herokuapp.com/appointment/find/' .$id);

        $responseBody = json_decode($response,true);
        

        $responseRepeat = Http::withHeaders([
            'Authorization' => Session::get('token')->token,
        ])->post('https://hospitalx-back.herokuapp.com/appointment/detail',[
            'AppointmentID' => $responseBody['data']['_id'],
            'Registrant' => Session::get('token')->data->username,
        ]);


        $responseRepeatBody = json_decode($responseRepeat->body());

        $appointment = $responseBody['data'];

        array_push($appointment,Session::get('token')->data->username);
        if($responseRepeatBody->status == 200)
        array_push($appointment,$responseRepeatBody->data);
        else
        array_push($appointment,false);

        $users = app('App\Http\Controllers\AuthController')->isAdmin(Session::get('token')->data->_id);


        return view('detail',compact('appointment','users'));
        
    }
}
