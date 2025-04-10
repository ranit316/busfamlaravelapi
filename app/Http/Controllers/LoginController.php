<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->responseData($validation->errors(), "Validation error", false);
        } else {
            $user =  User::where("email", $request->email)->first();
        }

        if (!$user) {
            return $this->responseData("", "Record not matched with our records", false);
        }


        if (Hash::check($request->password, $user->password)) {
            $token = $user->createToken('user-' . $user->id)->plainTextToken;

            //$cutstomer->token = $token;
            $data = User::where('email', $request->email)->first();
            $data['token'] = $token;

            return $this->responseData($data, "Login Successfully");
        } else {
            return $this->responseData("", "Credential not match", false);
        }
    }
}
