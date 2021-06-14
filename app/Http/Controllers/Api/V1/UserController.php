<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $createNewUser = new CreateNewUser();
        $user = $createNewUser->create($request->all());
        $token = $user->createToken('app_token')->plainTextToken;
        $user->assignRole('announcer');
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string', new Password]
        ]);

        $user = User::where('email', $fields['email'])->first();
        $password = $fields['password'];
        //check user
        if(!$user){
            return response([
                'message' => 'invalid data was given',
                'errors' => [
                    'email' => 'your email is not correct'
                ]
            ], 422);
        }
        //check password
        if(!Hash::check($password, $user->password)){
            return response([
                'message' => 'invalid data was given',
                'errors' => [
                    'password' => 'your password is not correct'
                ]
            ], 422);
        }
        $token = $user->createToken('mobile')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    public function logout(User $user)
    {
        $user->tokens()->delete();
        $response = [
            'message' => 'your are logged out! bye bye'
        ];
        return response($response, 201);
    }


}
