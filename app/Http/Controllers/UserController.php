<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $name = 'User';

    // LOGIN
    public function login(Request $request){
        // Check if User is exist.
        $user = User::where('email', $request->email)->first();
        if(!$user){
            $message = $this->name . ' Not Found.';
            return $this->JsonResponse($message, '', 404);
        }

        // Check if Username and Password is valid.
        if (!$user || ! Hash::check($request->password, $user->password)) {
            $message = 'Invalid Credentials';
            return $this->JsonResponse($message, '', 422);
        }

        $user['api_token'] = $user->createToken('api_token')->plainTextToken;
        $message = $this->name . ' Successfully Logged In.';

        return $this->JsonResponse($message, $user, 200);
    }

    // REGISTER
    public function register(RegisterRequest $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $response = User::create($data);

        $response['api_token'] = $response->createToken('api_token')->plainTextToken;
        $message = $this->name . ' Successfully Created.';
        return $this->JsonResponse($message, $response, 200);
    }


    // PROFILE
    public function profile(Request $request){
        return Auth::user();
    }


    // LOGOUT
    public function logout(Request $request){
        $user = Auth::user();
        $user->tokens()->delete();

        $message = $this->name . ' Successfully Logged Out.';
        return $this->JsonResponse($message, '', 204);
    }
}
