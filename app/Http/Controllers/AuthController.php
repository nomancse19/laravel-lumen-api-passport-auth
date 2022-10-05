<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function direct_login(Request $request){
            $email=$request->email;
            $password=$request->password;
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status'=>true,
                    'message'=>"Email And Password Not Be Empty",
                ]);
            }

            else{
                $user = User::where('email', $request->email)->first();
                if ((Hash::check($request->password, $user->password))) {
                    $token = $user->tokens()->each(function($token){
                        $token->delete();
                    });
                    $token = $user->createToken('DirectLoginToken')->accessToken;
                    return response()->json([
                        'status'=>true,
                        'message'=>"Login Success",
                        'token'=>$token,
                        'type'=>'Bearer',
                    ]);
                }else{
                    return response()->json([
                        'status'=>true,
                        'message'=>"Your Credintial is Wrong",
                    ]);
                }
            }




    }

    public function client_login(Request $request){
        $email=$request->email;
        $password=$request->password;
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'=>true,
                'message'=>"Email And Password Not Be Empty",
            ]);
        }
        

           try{
            $client= new Client();
            $data=$client->post(config('service.passport.login_endpoint'),[
                "form_params"=>[
                    "client_secret"=>config('service.passport.client_secret'),
                    "grant_type"=>"password",
                    "client_id"=>config('service.passport.client_id'),
                    "username"=>$request->email,
                    "password"=>$request->password

                ],
               // 'debug' => true,
                
                ]);
                //return $data->getbody();
                $my_data= json_decode($data->getbody());
            return response()->json([
                'status'=>true,
                'message'=>"Login Successfully",
                'data'=>$my_data
            ]);     
           }catch(Exception $e){
            return response()->json([
                'status'=>true,
                'message'=>$e->getMessage(),
            ]);
           } 
        

        
    }


    
    public function logout (Request $request) {
        $token = $request->user()->tokens()->each(function($token){
            $token->delete();
        });
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }




}