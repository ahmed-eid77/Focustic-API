<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\PasswordReset;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use HttpResponses;

    // Login Function
    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('', 'Credentials do not match', 401);
        }

        $user = User::where('email', $request->email)->first();
        return $this->success([
            'user'  => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
        ]);
    }


    // Register Function
    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user_data = User::where('id', $user->id)->first();

        return $this->success([
            'user' => $user_data,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
        ]);
    }


    // Logout Function
    public function logout()
    {
        try {
            Auth::user()->currentAccessToken()->delete();
            return $this->success([
                'You have successfully been logged out and your token has been deleted'
            ]);
        } catch (\Exception $e) {
            return $this->error('', 'Something went wrong!', 501);
        }
    }

    //========================================================

    // Verification Email

    // 1- Send The Verification Email
    public function sendVerifyEmail($email)
    {

        if (auth()->user()) {

            $user = User::where('email', $email)->get();

            if (count($user) > 0) {

                $random = Str::random(40);
                $domain = URL::to('/');
                $url    = $domain . "/verify-email/" . $random;

                // Build The Email Verification Data
                $data['url']   = $url;
                $data['email'] = $email;
                $data['title'] = 'Email Verification';
                $data['body']  = 'Please click the below button to verify your email';

                // Send The Verify Email
                Mail::send('verifyMail', ['data' => $data], function ($message) use ($data) {
                    $message->to($data['email'])->subject($data['title']);
                });

                // Find The User And Change The Remember Token
                $user = User::find($user[0]['id']);
                $user->remember_token = $random;
                $user->save();

                //Send Email Sent Response
                return $this->success('', 'Mail Sent Successfully');
            } else {
                return $this->error('User is not found!', 401);
            }
        } else {
            return $this->error('User is Authenticated', 401);
        }
    }

    // 2- Verify The Email
    public function verificationEmail($token)
    {

        $user = User::where('remember_token', $token)->get();

        if (count($user) > 0) {
            $dateTime = Carbon::now()->format('Y-m-d H:i:s');
            $user = User::find($user[0]['id']);
            $user->remember_token = '';
            $user->email_verified_at = $dateTime;
            $user->save();

            return "<h1>Email Verified Successfully</h1>";
        } else {
            return view('404');
        }
    }

    //========================================================
    // Forget Password Api

    // 1 - To Send Email For Password Reset
    public function forgetPassword(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->get();

            if (count($user) > 0) {
                // Generate The Token
                $token = Str::random(40);
                $domain = URL::to('/');
                $url    = $domain . "/reset-password?token=" . $token;

                // Build The Email For Reset Password
                $data['url']   = $url;
                $data['email'] = $request->email;
                $data['title'] = 'Password Reset';
                $data['body']  = 'Please click the below button to reset your password';

                // Send The Reset Email
                Mail::send('forgetPasswordMail', ['data' => $data], function ($message) use ($data) {
                    $message->to($data['email'])->subject($data['title']);
                });

                $datetime = Carbon::now()->format('y-m-d H:i:s');
                PasswordReset::updateOrCreate(
                    ['email' => $request->email],
                    [
                        'email'      => $request->email,
                        'token'      => $token,
                        'created_at' => $datetime
                    ]
                );
                return $this->success('', 'Please Check Your email to reset Your password.');
            } else {
                return $this->error('', 'User is not found!', 401);
            }
        } catch (\Exception $e) {
            return $this->error('', $e->getMessage(), 401);
        }
    }

    // 2 - To Load Password Reset View
    public function resetPasswordLoad(Request $request)
    {
        $resetData = PasswordReset::where('token', $request->token)->get();
        if (isset($request->token) && count($resetData) > 0) {
            $user = User::where('email', $resetData[0]['email'])->get();
            return view('resetPassword', compact('user'));
        } else {
            return view('404');
        }
    }

    // 3 - Password Reset Functionality
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->save();

        PasswordReset::where('email', $user->email)->delete();

        return "<h1>Your Password has been reset Successfully</h1>";
    }
}
