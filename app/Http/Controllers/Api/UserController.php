<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;


class UserController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 

            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            // $success['name'] =  $user->name;
            return response()->json($success);

                }
                else
                {
                    return ['error'=>'Unauthorised'];
                }
                  
            
            }

            public function register(Request $request)
            {

        $validator=Validator::make($request->all(),
        [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]
        
        );
        if($validator->fails()){
            return $validator->errors();  
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        // $success['name'] =  $user->name;
        return response()->json($success);

            }
}