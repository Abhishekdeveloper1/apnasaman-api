<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
// use Auth;
class UserController extends Controller
{
    // function __construct()
    // {
    //     // exit('kakaka');
    //     // $a=Request $request;
    //     // print_r($request);die;
    // }
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 

            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            // $success['name'] =  $user->name;
            Log::info('Successfully login:', ['token' => $success]);
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
                return response()->json([
                    'success' => false,
                    'message' => 'Validation errors',
                    'error' => $validator->errors()
                ], 422); 
            }
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            Log::info('Successfully registerd:', ['id' => $user]);

            return response()->json($success);

                }

            function userinfo(Request $request)
            {
                // print_r('111');die;

                $user = Auth::user();
                if ($user) {
                    Log::info('Uer Data: {id}', ['id' => $user]);
                    return response()->json(['user' => $user], 200);
                } else {
                    Log::info('User not authenticated:');
                    return response()->json(['error' => 'User not authenticated'], 401);
                }
            
            }
        
            public function logout(Request $request) {
                $token = $request->user()->token();
                // echo $token;die;
                $token->revoke();
                $response = ['message' => 'You have been successfully logged out!'];
                return response($response, 200);
            }
}
