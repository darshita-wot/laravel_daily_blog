<?php

namespace App\Repositories\Admin;
use App\Contracts\Admin\UserContracts;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Request;

class UserRepository implements UserContracts
{
    private $apiReturnData = [];

    public function __construct(User $user, Request $request)
    {
        $this->model = $user;
        $this->request = $request;
    }

    public function userList()
    {
        if ($this->request->ajax()) {


            // Log::info('page', [$this->request->pagination]);
            // Log::info('sort', [$this->request->sort]);

            $page = $this->request->pagination['page'];
            $perpage = $this->request->pagination['perpage'];

            $field = $this->request->sort['field'];
            $sort = $this->request->sort['sort'];

            $skip = ($page - 1) * $perpage;

            $search = array();

            if ($this->request['query'] != null) {
                // $search = $request->input('query');
                $search = array_values($this->request['query']);

                Log::info("search ", $search);
            }
            $search_string = implode(" ", $search);
            Log::info('search string',[$search_string]);

            $users = User::orderBy($field,$sort)->where(function ($query) use ($search_string) {
                $query->where('name', 'like',  $search_string . '%')->orWhere('id', 'like',  $search_string . '%')->orWhere('mobile_no', 'like',  $search_string . '%')->orWhere('email', 'like',  $search_string . '%')
                ->orWhere('birth_date', 'like',  $search_string . '%');
            })->skip($skip)->take($perpage)->get();

            if (!empty($search_string)) {
                // Log::info("inside if", $search);
                $total_records = count($users);
            } else {
                $total_records = User::all()->count();
            }
            Log::info("inside else", [$total_records]);
            $this->apiReturnData['data'] = $users;
            $this->apiReturnData['meta'] = array("page" => $page, "pages" => ceil($total_records / $perpage), "perpage" => $perpage, "total" => $total_records);
            return $this->apiReturnData;
           
        }

    }

    public function editUser(){
        $edit_user_id = $this->request->id;
        Session(['edit_user_id' => $edit_user_id]);
        $this->apiReturnData['user_info'] = User::where('id',$this->request->id)->first();
        return $this->apiReturnData;
    }

    public function updateUser(){
        $status = User::Where('id',Session('edit_user_id'))->update(['name' => $this->request->fullname, 'email'=>$this->request->email,
            'password' =>  Hash::make($this->request->password),'mobile_no' => $this->request->mobile_no, 'birth_date'=>$this->request->birthday_date]);
        
        return $status;
    }

    public function deleteUser(){
        $status = User::where('id',$this->request->id)->delete();
        Log::info('status',[$status]);
        return $status;
    }
}