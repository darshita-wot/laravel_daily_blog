<?php

namespace App\Http\Controllers;

use App\Contracts\UserContracts;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct(Request $request, UserContracts $userContracts)
    {
        $this->request = $request;
        $this->repo = $userContracts;
    }

    public function userRegistration()
    {
        try {
            $validator = Validator::make(
                $this->request->all(),
                [
                    'fullname' => 'string|required|min:5',
                    'email' => 'string|email|required|max:100|unique:users',
                    'password' => 'string|required|min:5',
                    'mobile_no' => 'required|unique:users',
                    'birthday_date' => 'required',

                ],
                [
                    'fullname.string' => "Please enter valid Name",
                    'email.string' => "Please enter valid Email",
                    'password.string' => "Please enter valid Password",
                ]
            );

            if (!$validator->passes()) {
                // Log::info('data',[$validator->errors()]);
                return response()->json(['status' => 'error', 'data' => $validator->errors()]);
            } else {
                Log::info('data', [$this->request->all()]);
                $data = $this->repo->userRegistration();
                if (!empty($data)) {
                    return response()->json(['status' => 'success', 'data' => 'user added']);
                } else {
                    return response()->json(['error' => 'Error in User registration']);
                }
            }
        } catch (Exception $e) {
            return response()->json(['failed' => $e->getMessage()]);
        }

    }

    public function userLogin()
    {
        try {
            $validator = Validator::make(
                $this->request->all(),
                [
                    'username' => 'string|required|min:5',
                    'password' => 'string|required|min:5'
                ],
                [
                    'username.string' => "Please enter valid Name",
                    'password.string' => "Please enter valid Password"
                ]
            );

            if (!$validator->passes()) {
                return response()->json(['status' => 'error', 'data' => $validator->errors()]);
            }

            $is_login = $this->repo->userLogin();

            if ($is_login) {
                return response()->json(['status' => 'success', 'data' => 'user loggedin']);
            } else {
                return response()->json(['status' => 'invalid', 'data' => 'Invalid login credentials']);
            }
        } catch (Exception $e) {
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    public function forgotPassword()
    {
        try {

            $data = $this->repo->forgotPassword();

            if ($data) {
                return response()->json(['status' => 'success', 'data' => 'Please check your mail to reset your password']);
            } else {
                return response()->json(['status' => 'error', 'data' => "Email doesn't exists"]);
            }

        } catch (Exception $e) {
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    public function loadResetPassword()
    {
        try {
            $user = $this->repo->loadResetPassword();
            if ($user) {
                return view('resetPassword', compact('user'));
            } else {

                return view('404');
            }

        } catch (Exception $e) {
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    public function resetPassword()
    {
        try {
            $validator = Validator::make($this->request->all(), [
                'password' => 'string|required|min:5|confirmed',
            ], [
                    'password.string' => "Please enter valid Password"
                ]);

            if (!$validator->passes()) {
                Log::info('inside validation');
                return response()->json(['status' => 'error', 'data' => $validator->errors()]);
            } else {

                $data = $this->repo->resetPassword();

                if ($data) {
                    return response()->json(['status' => 'success', 'data' => 'password changed']);
                }

            }
        } catch (Exception $e) {
            return response()->json(['failed' => $e->getMessage()]);
        }

    }

    public function logout()
    {

        $status = $this->repo->logout();
        if ($status) {
            return redirect('/login');
        } else {
            return redirect('/login');
        }
    }

    public function getProfileView(){
        // $user = User::where('id',Session('id'))->first();
        // Log::info('user',[$user]);
        $user = $this->repo->getProfileView();
        if($user){
            return view('user.userProfile',compact('user'));
        }

    }

    public function profileupdate()
    {
        Log::info('file ----- ',[$this->request->file('profile_avatar')]);
        $data = $this->repo->profileupdate();
        if(isset($data['status'])){
            return response()->json(['status' => 'success', 'profile_photo' => $data['profile_photo']]);
        }
    }
}