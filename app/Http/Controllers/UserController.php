<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */

    public function __invoke(Request $request)
    {

        //
    }
    public function login(Request $request) {
        $this->middleware('cors');
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if ($validator->failed()) {
            return response()->json(['status'=>FALSE,
                'error'=>[
                    'type'=>'alert',
                    'errors'=>$validator->errors()
                ],
                ], 401);
        }
        if (Auth::attempt(['email'=>request('email'), 'password'=>request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['username'] = $user->name;
            return response()->json([
                'data'=>$success,
                'status'=>TRUE
            ]);
        }
        return response()->json([
            'error'=>[
                'type'=>'toast',
                'message'=> 'Email or Password incorrect'
            ],
            'status'=>FALSE
        ], 401);
    }
    public function registration(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'email'=>'email|required',
            'password'=>'required',
            'c_password'=>'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'=>FALSE,
                'error'=>[
                    'type'=>'alert',
                    'errors'=>$validator->errors()
                ]
            ], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['username'] = $user->name;
        return response()->json(['status'=>TRUE,
            'data'=>$success]);
    }
}
