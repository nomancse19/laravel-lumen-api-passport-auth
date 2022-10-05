<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function get_post_data(){
        $new_data=PostModel::all();
        $new_data= array_values($new_data->toArray());
       // return $new_data;
        //return PostModel::all();
        return response()->json(
            [   'status'=>true,
                'message' => 'Data Found',
                'data' => $new_data,
                'status_code' => 200,
            ]);
    }
    public function user_info(){
        $new_data=User::all();
        $new_data= array_values($new_data->toArray());
       // return $new_data;
        //return PostModel::all();
        return response()->json(
            [   'status'=>true,
                'message' => 'Data Found',
                'data' => $new_data,
                'status_code' => 200,
            ]);
    }


    public function store_data(Request $request){
        try{
            $post= new PostModel();
            $post->post_title=$request->post_title;
            $post->post_body=$request->post_body;
            if($post->save()){
                return response()->json([
                    'status'=>true,
                    'message' => 'Data Added Suucessfully',
                    //'data' => $new_data,
                    'status_code' => 200,
                ]);
            }

        }catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message' => $e->getMessage(),
            ]);
        }
    }



}