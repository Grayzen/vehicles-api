<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function register(Request $request)
    {
        try{
            $user = new User;
            $user->email = $request->email;
            $user->password = app('hash')->make($request->password);
            if($user->save())
            return $this->login($request);
                // return response()->json(['status' => 'success', 'message' => 'User Created Successfully']);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error on User Register!']);
        }
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if(empty($email) || empty($password))
            return response()->json(['status' => 'error', 'message' => 'Error on Authtication!']);

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials))
            return response()->json(['error' => 'Unauthorized'], 401);

        return $this->respondWithToken($token);
    }
    public function me()
    {
        return response()->json(auth()->user());
    }


    public function logout()
    {
        dd(auth()->user());
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    protected function respondWithToken($token)
    {
        try{
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 120
            ]);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error on Token Response!']);
        }
    }

}
