<?php

namespace App\Repositories;

use App\Contracts\UserContracts;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Request;

class UserRepository implements UserContracts
{

    private $apiReturnData = [];
    
    public function __construct(User $user, Request $request)
    {
        $this->model = $user;
        $this->request = $request;
    }

    public function userRegistration()
    {
        $user = User::create([
            'name' => $this->request->fullname,
            'email' => $this->request->email,
            'password' => Hash::make($this->request->password),
            'mobile_no' => $this->request->mobile_no,
            'birth_date' => $this->request->birthday_date
        ]);

            $user->assignRole('user');

        return $user;
    }

    public function userLogin()
    {
        $fieldType = filter_var($this->request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $rememberMe = $this->request->has('remember') ? true : false;

        if ($this->request->has('remember')) {
            setcookie('username', $this->request->username, time() + 60 );
            setcookie('password', $this->request->password, time() + 60 );
        }

        if (auth()->attempt([$fieldType => $this->request->username, 'password' => $this->request->password], $rememberMe)) {
            $user = Auth::user();
            $id = Auth::id();

            Log::info("user id", [$id]);
            Log::info("user", [$user]);
            session(['id' => $id, 'name' => $user->name]);
            Log::info("name", [$user->name]);

            return true;
        }
    }

    public function forgotPassword()
    {

        //get user
        $user = User::where('email', $this->request->email)->get();

        if (count($user) > 0) {
            //when user exists
            // 1. generate random token
            $token = strtolower(str()->random(40));
            $domain = URL::to('/');

            $url = $domain . '/resetpassword?token=' . $token;

            // make array to pass data in email
            $data['url'] = $url;
            $data['email'] = $this->request->email;
            $data['title'] = "Password Reset";
            $data['body'] = "Please click on below link to reset your password";

            //make view to send mail
            Mail::send('forgorPasswordMail', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });

            $dateTime = Carbon::now()->format('Y-m-d H-i-s');
            Log::info('email', [$this->request->email]);

            // it takes two array 1st condition 2nd value
            PasswordResetToken::updateOrCreate(
                ['email' => $this->request->email],
                [
                    'email' => $this->request->email,
                    'token' => $token,
                    'created_at' => $dateTime
                ]
            );
            return true;
        } else {
            return false;
        }
    }

    public function loadResetPassword()
    {

        // $resetData = PasswordResetToken::query()->where('token', $this->request->token)->first();
        $resetData = DB::table('password_reset_tokens')->where('token', $this->request->token)->first();
        Log::info('reset data', [$resetData]);
        if (isset($this->request->token) && !empty($resetData)) {

            $user = User::where('email', $resetData->email)->first();
            Log::info('reset password user details', [$user]);

            return $user;

        }

    }

    public function resetPassword()
    {

        $user = User::find($this->request->id);
        Log::info("user found", [$user]);

        $user->password = Hash::make($this->request->password);
        $user->save();

        PasswordResetToken::where('email', $user->email)->delete();

        return true;
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return true;

    }

    public function getProfileView()
    {
        $user = User::where('id',Session('id'))->first();
        Log::info('user',[$user]);
        return $user;
    }

    public function profileupdate()
    {
        if ($this->request->file('profile_avatar') != null) {
           
            //Upload image inside public/images folder
            $image = $this->request->file('profile_avatar');
            $name = $image->getClientOriginalName();
            $path = $this->request->file('profile_avatar')->store('images', 'public');
            Session('profile_photo');
        }else{
           $user =  User::where('id', $this->request->id)->first();
           $path = $user->profile_photo;
        }
        $status = User::where('id', $this->request->id)->update(['profile_photo' => $path, 'name' => $this->request->fullname,'email'=> $this->request->email]);
            
        Log::info('path',[$path]);
        Log::info('status',[$status]);
        $this->apiReturnData['status'] = $status;
        $this->apiReturnData['profile_photo'] = $path;
        return $this->apiReturnData;
    }
}