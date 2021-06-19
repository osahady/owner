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
        $phoneRegex = require_once __DIR__ . '../../../../../Constants/phone_regex.php';
        $fields = $request->validate([
            'phone' => ['required', 'regex:/' . $phoneRegex . '/u'],
            // 'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string', new Password]
        ]);

        $user = User::where('phone', $fields['phone'])->first();
        $password = $fields['password'];
        //check user
        if (!$user) {
            return response([
                'message' => 'invalid data was given',
                'errors' => [
                    'email' => 'your email is not correct'
                ]
            ], 422);
        }
        //check password
        if (!Hash::check($password, $user->password)) {
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

    public function codes()
    {
        $codes = require_once __DIR__ . '../../../../../Constants/codes.php';
        $prefixes = [];
        $regex = '';
        for ($i = 0; $i < count($codes); $i++) {
            $regex .= '(^\\' . $codes[$i]['dial_code'] . '(';
            $prefixes = $codes[$i]['prefix'];
            for ($j = 0; $j < count($prefixes); $j++) {
                $regex .= $prefixes[$j] . '|';
            }
            // $regex = substr($regex, 0, -1); //remove last char `|`
            $regex = rtrim($regex, '|');
            $regex .= ')';
            $regex .= '\\d{' . $codes[$i]['remain_digits'] . '}$)|';
        }
        $regex = rtrim($regex, '|');
        return $regex;
    }
}
