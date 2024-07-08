<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest_SA;
use App\Http\Requests\UserLoginRequest_SA;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource_SA;

use Auth;

class LoginRegisterControllers extends Controller
{

    public function register(UserRegisterRequest_SA $request)
    {
        dd($request);
        echo "hellllo from register";
        $user = User::create([
            'name' => $request->input['name'],
            'email' => $request->input['email'],
            'password' => bcrypt($request->input['password'])

        ]);

        return userResponse("User Registered Sucessfully!", UserResource_SA::make($user));
    }

    public function Login(UserLoginRequest_SA $request)
    {

        if (!$token = auth()->attempt($request->all())) {
            return userResponse("Unauthenticated User", false, 404);
        }

        return $this->getToken($token);
    }

    protected function getToken($token)
    {
        return response()->json([
            'acess_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}