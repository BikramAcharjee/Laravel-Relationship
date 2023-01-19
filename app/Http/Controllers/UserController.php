<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware("auth:api", ["except" => ["Login","Register"]]);
    }

    public function Register(Request $request) {
        $request->validate([
            "name"=> "required|string",
            "email"=> "required|email|unique:users",
            "phone"=> "required|numeric|digits:10",
            "password"=> "required|min:6"
        ]);

        $hasPassword = Hash::make($request->password,["round"=>12]);
        $request['password'] = $hasPassword;

        try {
            //code...
            $UserData = User::create($request->all());
            return response()->json(["message"=>"Registered Successfully","data"=>$UserData],201);

        } catch (\Throwable $th) {
            //throw $th;
            if($th->getCode() === "23000")
            return response(array("message" => "Email already exist !"),409)->header("Content-Type","application/json");
            
            return response(array("message"=>$th->getMessage()),400)->header("Content-Type","application/json");
        }

    }

    public function Login(Request $request) {
        $request->validate(["email"=>"required|email","password" => "required"]);
        $credentials = request(['email', 'password']);

        if (! $token = Auth::attempt($credentials))
        return response()->json(['error' => 'Unauthorized'], 401);

        return $this->respondWithToken($token);
    }

    public function Refresh(Request $request) {
        return response()->json(["refreshToken"=>auth()->refresh()],201);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
