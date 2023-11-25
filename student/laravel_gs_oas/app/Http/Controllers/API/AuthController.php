<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;


class AuthController extends Controller
{
    public function register( Request $request){
        $data = $request->validate([
            "first_name" => ['required', 'string'],
            "last_name" => ['required', 'string'],
            "gender" => ['required', 'string'],
            "dob" => ['required', 'date', 'date_format:d-m-Y'],
            "phone_number" => ['required', 'string'],
            'email' => 'required|unique:users',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'role_id' => 'required',
        ]);

        $dob = Carbon::createFromFormat('d-m-Y', $data['dob'])->format('Y-m-d');
        // Add the converted date to the validated data array
        $data['dob'] = $dob;

        // Set default role to 'applicant' when user register
        $userData = array_merge($data, ['role_id' => $data['role_id'] ?? 1]);


        // Mass assign the validated request data to a new instance of the User model
        $user = User::create($userData);
        $token = $user->createToken('my-token')->plainTextToken;

        $id = $request->role_id;
        if($request->role_id == null) {
            $id = 1;
        }

        $role = Role::find($id);

        return response()->json([
            'user' => $user,
            'token' => $token,
            'Type' => 'Bearer',
            'role' => $role->name,
        ]);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'message' => 'Wrong credentials'
            ]);
        }

        $token = $user->createToken('my-token')->plainTextToken;

        $role = Role::find($user->role_id);

        return response()->json([
            'user' => $user,
            'token' => $token,
            'Type' => 'Bearer',
            'role' => $role->name
        ]);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    //request password reset through email
    public function forgotPassword(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);

        // Laravel's built-in Password facade is used to send a reset link to the user's email
        $status = Password::sendResetLink(
            $request->only('email')
        );
        if($status == Password::RESET_LINK_SENT){
            return [
                'status' => __('A password reset link has been sent to your email.'),
            ];
        }
        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    //reset the password
    public function resetPassword(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            //required password and confirmed password
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                 //to delete the old token
                $user->tokens()->delete();
                //laravel built in function
                event(new PasswordReset($user));
         }
        );

        if($status == Password::PASSWORD_RESET) {
            return response([
                'message'=> 'Password reset sucessfully'
            ]);
        }
        return response([
            'message'=> __($status)
        ],500);
    }
}

