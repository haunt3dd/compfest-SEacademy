<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class AuthController extends Controller
{
    public function isAdmin($id){
        $response = Http::withHeaders([
            'Authorization' => Session::get('token')->token,
        ])->post('https://hospitalx-back.herokuapp.com/patient/role',[
            'id' => $id,
        ]);

        
        $responseBody = json_decode($response->body());
        return $responseBody->data;
    }

    public function login(Request $request){
        
            $response = Http::post('https://hospitalx-back.herokuapp.com/login',[
                'username' => $request['username'],
                'password' => $request['password']
            ]);
            $responseBody = json_decode($response->body());
            
            if($responseBody->status == 500){
                return redirect()->route('login')->with('message', $responseBody->message);
            }
            

            Session::put('token',$responseBody);
            

            // dd(Session::get('token'));
            $users = app('App\Http\Controllers\AuthController')->isAdmin(Session::get('token')->data->_id);

            return redirect()->route('home');
        }
        
        public function register(Request $request){
            $response = Http::post('https://hospitalx-back.herokuapp.com/patient',[
                'firstName' => $request['first_name'],
                'lastName' => $request['last_name'],
                'age' => $request['age'],
                'email' => $request['email'],
                'username' => $request['username'],
                'password' => $request['password']
            ]);
            $responseBody = json_decode($response->body());

            return redirect()->route('login')->with('message', $responseBody->message);
        }

        public function logout(){
            Session::forget('token');

            return redirect()->route('login')->with('message', 'Sucessfully Logout');
        }
}
