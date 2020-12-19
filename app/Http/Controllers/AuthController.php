<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        
        $request->validate([
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required|min:6'
        ]);

        // $this->validator($request->all())->validate();


        $user = User::create([
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => bcrypt($request->password),
            'api_token'=>Str::random(60)
        ]);

        return response()->json($user);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email', 
            'password' => 'required'
        ]);

   
        if( Auth::attempt(['email'=>$request->email, 'password'=>$request->password]) ) {

            $user = Auth::user();

            $user->generateToken();

            return response()->json([
                'data' => $user->toArray(),
            ]);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();
    
        if ($user) {
            $user->api_token = null;
            $user->save();
        }
    
        return response()->json(['data' => 'User logged out.'], 200);
    }


}
