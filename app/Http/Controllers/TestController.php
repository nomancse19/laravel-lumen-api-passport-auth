<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Exception;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function get_post_data(){
        $new_data=PostModel::all();
       // $new_data= array_values($new_data->toArray());
       // return $new_data;
        //return PostModel::all();
        return response()->json(
            [   'status'=>true,
                'message' => 'Data Found',
                'data' => $new_data,
                'status_code' => 200,
            ]);
    }


    public function store_data(){
        try{
            $data=100;
            if($data==50){
                return response()->json(
                    [   'status'=>true,
                        'message' => 'Data Not Found',
                        'data' => $data,
                        'status_code' => 200,
                    ]);
            }else{
                throw new Exception("Value must be 1 or below");
            }
        }catch(\Exception $e){
            return response()->json(
                [   'status'=>false,
                    'message' => 'Data Not Found',
                    'data' => $e->getMessage(),
                    'status_code' => 200,
                ]);
        }
    }



}