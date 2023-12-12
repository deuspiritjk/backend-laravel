<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// based-on https://medium.com/@kingasiadavid41/laravel-10-api-authentication-using-passport-696940976a56
// for user crud

class AuthenticationController extends Controller
{
    //
    public function store()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = User::find(Auth::user()->id);
            $user_token['token'] = $user->createToken('appToken')->accessToken;
            return response()->json([
                'success' => true,
                'token' => $user_token,
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to autenticate.'
            ], 401);
        }
    }
    public function logout(Request $request)
    {
        if (Auth::user()) {
            $request->user()->token()->revoke();
            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully',
            ], 200);
        }
    }

    public function getUserInfo()
    {
        if (Auth::user()) {
            $id = Auth::user()->id;
            $user = User::find($id);
            return $user;
        }
        return response()->json([
            'success' => false,
            'message' => 'Failed to autenticate.'
        ], 401);
    }

    // based-on https://www.toptal.com/laravel/passport-tutorial-auth-user-access
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->toArray());
        $token = $user->createToken('appToken')->accessToken;
        $response = ['token' => $token];
        // return response($response, 200);
        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    public function logoutEverywhere(Request $request)
    {
        if (Auth::user()) {
            $request->user()->tokens()->delete();
            return response()->json([
                'success' => true,
                'message' => 'Logged out everywhere',
            ], 200);
        }
    }
    public function destroy(Request $request)
    {
        // based-on https://stackoverflow.com/questions/58280790/remove-a-laravel-passport-user-token
        if (Auth::user()) {
            $request->user()->tokens()->delete();
            User::destroy(Auth::user()->id);
            return response()->json([
                'success' => true,
                'message' => 'user accound deleted successfuly!!!'
            ]);
        }
    }
}
