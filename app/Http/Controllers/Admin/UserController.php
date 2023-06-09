<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Admin\UserContracts;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct(Request $request, UserContracts $userContracts)
    {
        $this->request = $request;
        $this->repo = $userContracts;
        $this->middleware(['role:admin']);
    }

    public function userList()
    {
        $data = $this->repo->userList();
        return response()->json([
            'status' => 'success',
            'data' => $data['data'],
            "meta" => $data['meta']
        ]);
    }

    public function editUser(){
        try{
            $data = $this->repo->editUser();
            return response()->json(['status'=>'success','data' => $data]);
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    public function updateUser(){
        try{
            $validator = Validator::make(
                $this->request->all(),
                [
                    'fullname' => 'string|required|min:5',
                    'email' => [
                        // Rule::unique('users')->ignore(session('id')),
                    ],
                    'password' => 'string|required|min:5',
                    'mobile_no' => 'required',
                    'birthday_date' => 'required',

                ],
                [
                    'fullname.string' => "Please enter valid Name",
                    'email.string' => "Please enter valid Email",
                    'password.string' => "Please enter valid Password",
                ]
            );

            if (!$validator->passes()) {
                return response()->json(['status' => 'error', 'data' => $validator->errors()]);
            }
            else{
                $status = $this->repo->updateUser();
                if($status){
                    return response()->json(['status' => 'success','data' => 'User Details Updated successfully']);
                }else{
                    return response()->json(['status' => 'error','data' => "Couldn't updated User Details"]);
                }
            }
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    public function deleteUser(){
        try{
            $status = $this->repo->deleteUser();
            if($status){
                return response()->json(['status'=>'success','data' => 'User deleted']);
            }else{
                return response()->json(['status'=>'error','data' => 'User not deleted']);
            }
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    public function changeUserStatus(){
        try{
            $status = $this->repo->changeUserStatus();
            if($status){
                return response()->json(['status'=>'success','data' => 'User Status changed']);
            }else{
                return response()->json(['status'=>'error','data' => 'User status not changed!']);
            }
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    public function userPermissionList(){
        $data = $this->repo->userPermissionList();
        return response()->json([
            'status' => 'success',
            'data' => $data['data'],
            "meta" => $data['meta']
        ]);
    }

    public function changeBlogPermission(){
        try{
            $status = $this->repo->changeBlogPermission();
            if($status){
                return response()->json(['status'=>'success','data' => 'User permission changed']);
            }else{
                return response()->json(['status'=>'error','data' => 'User Permission removed!']);
            }
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }
}