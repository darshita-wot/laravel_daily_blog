<?php

namespace App\Http\Controllers;

use App\Contracts\UserContracts;
use App\Http\Requests\UserStoreRequest;
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

    public function userRegistration(UserStoreRequest $request)
    {
        try {
            // $validated = $request->validated();
            // Log::info('validated - ',[$validated]);
         
            // if (!$validator->passes()) {
            //     // Log::info('data',[$validator->errors()]);
            //     return response()->json(['status' => 'error', 'data' => $validator->errors()]);
            // } else {
                
                $data = $this->repo->userRegistration($request);
                if (!empty($data)) {
                    return response()->json(['status' => 'success', 'data' => 'user added'],200);
                } else {
                    return response()->json(['error' => 'Error in User registration']);
                }
            // }
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
                return response()->json(['status' => 'invalid', 'data' => 'Invalid login credentials'],401);
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
                return response()->json(['status' => 'success', 'data' => 'Please check your mail to reset your password'],200);
            } else {
                return response()->json(['status' => 'error', 'data' => "Email doesn't exists"],404);
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

    public function setProfile(){

        $profile_photo = $this->repo->setProfile();
        if(!empty($profile_photo)){
            return response()->json(['status'=>'success','profile_photo' => $profile_photo]);
        }else{
            return response()->json(['status'=>'error']);
        }


    }

    public function getProfileView(){
        // $user = User::where('id',Session('id'))->first();
        // Log::info('user',[$user]);
        $user = $this->repo->getProfileView();
        if($user){
            return view('user.usersProfile',compact('user'));
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

    public function userProfileView(string $id){
        $user_data = $this->repo->userProfileView($id);
        $user = $user_data['user_data'];
        $rating = $user_data['averageRating'];
        Log::info('user profile view ',[$user]);
        return view('userProfileVisit',compact('user','rating'));
    }

    public function userPendingTaskView(){
        
        return view('user.userPendingTask');
        
    }

    public function userPendingTaskList(){
        $data = $this->repo->userPendingTaskList();
        return response()->json([
            'status' => 'success',
            'data' => $data['data'],
            "meta" => $data['meta']
        ]);
    }
    
    public function commentAprrove(){
        try{
            $status = $this->repo->commentAprrove();
            if($status){
                return response()->json(['status'=>'success','data' => 'Comment approved']);
            }
            
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    public function changePassword()
    {
        try {
            $validator = Validator::make($this->request->all(), [
                'password' => 'string|required|min:5|confirmed',
            ], [
                    'password.string' => "Please enter valid Password"
                ]);

            if (!$validator->passes()) {
              
                return response()->json(['status' => 'error', 'data' => $validator->errors()]);
            } else {

                $data = $this->repo->changePassword();

                if ($data) {
                    return response()->json(['status' => 'success', 'data' => 'password changed']);
                }

            }
        } catch (Exception $e) {
            return response()->json(['failed' => $e->getMessage()]);
        }

    }

    public function deleteUserAccount()
    {
        try {
            Log::info('delete id - ',[$this->request]);
                $status = $this->repo->deleteUserAccount();

                if ($status) {
                    return response()->json(['status' => 'success', 'data' => 'Account deleted']);
                }

            }
         catch (Exception $e) {
            return response()->json(['failed' => $e->getMessage()]);
        }
    }
}