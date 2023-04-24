<?php

namespace App\Repositories\Admin;

use App\Contracts\Admin\UserContracts;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Symfony\Component\HttpFoundation\Request;

class UserRepository implements UserContracts
{
    use HasPermissions;
    private $apiReturnData = [];

    public function __construct(User $user, Request $request)
    {
        $this->model = $user;
        $this->request = $request;
    }

    public function userList()
    {
        if ($this->request->ajax()) {

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
            Log::info('search string', [$search_string]);

            $users = User::orderBy($field, $sort)->where('name', '!=', 'admin')->where(function ($query) use ($search_string) {
                $query->where('name', 'like', $search_string . '%')->orWhere('id', 'like', $search_string . '%')->orWhere('mobile_no', 'like', $search_string . '%')->orWhere('email', 'like', $search_string . '%')
                    ->orWhere('birth_date', 'like', $search_string . '%');
            })->skip($skip)->take($perpage)->get();

            if (!empty($search_string)) {
                // Log::info("inside if", $search);
                $total_records = count($users);
            } else {
                $total_records = User::where('name', '!=', 'admin')->count();
            }
           
            $this->apiReturnData['data'] = $users;
            $this->apiReturnData['meta'] = array("page" => $page, "pages" => ceil($total_records / $perpage), "perpage" => $perpage, "total" => $total_records);
            return $this->apiReturnData;

        }

    }

    public function editUser()
    {
        $edit_user_id = $this->request->id;
        Session(['edit_user_id' => $edit_user_id]);
        $this->apiReturnData['user_info'] = User::where('id', $this->request->id)->first();
        return $this->apiReturnData;
    }

    public function updateUser()
    {
        $status = User::find(Session('edit_user_id'))->update([
            'name' => $this->request->fullname,
            'email' => $this->request->email,
            'password' => Hash::make($this->request->password),
            'mobile_no' => $this->request->mobile_no,
            'birth_date' => $this->request->birthday_date
        ]);

        return $status;
    }

    public function deleteUser()
    {
        $status = User::find($this->request->id)->delete();

        return $status;
    }

    public function changeUserStatus()
    {
        $status = User::where('id', $this->request->id)->update(['is_active' => $this->request->is_active]);
        Log::info('status', [$status]);
        return $status;
    }

    public function userPermissionList()
    {
        if ($this->request->ajax()) {

            

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
            Log::info('search string', [$search_string]);

            $users = User::orderBy($field, $sort)->where('name', '!=', 'admin')->where(function ($query) use ($search_string) {
                $query->where('name', 'like', $search_string . '%');
            })->skip($skip)->take($perpage)->get();

            $permission_names = [];
            foreach($users as $user) {
              $permissions =   $user->permissions;
              $permission_count = $user->permissions->count();
              Log::info('permissions count -',[ $permission_count]);
              $counter = 0;
              foreach($permissions as $permission){
                $counter++;
                    Log::info('permission name -',[$permission->name]);
                    Log::info('model_id -',[$permission->pivot->model_id]);
                    array_push($permission_names,$permission->name);
                   
                    if($counter ==  $permission_count)
                    {
                        $user->permission_names = $permission_names;
                        $permission_names = [];
                       
                    }
                    $user->model_id = $permission->pivot->model_id;
                 
                    
              }
            
            
                
            }

            if (!empty($search_string)) {
                // Log::info("inside if", $search);
                $total_records = count($users);
            } else {
                $total_records = User::where('name', '!=', 'admin')->count();
            }
           
            $this->apiReturnData['data'] = $users;
            $this->apiReturnData['meta'] = array("page" => $page, "pages" => ceil($total_records / $perpage), "perpage" => $perpage, "total" => $total_records);
            return $this->apiReturnData;
        }
    }
  
    public function changeBlogPermission()
    {
        $user = User::find($this->request->id);
        if($this->request->has('can_create'))
        {
            if($this->request->can_create == 1) {
                 $user->givePermissionTo('create-blog-posts');
                 return true;
            }else{
                $user->revokePermissionTo('create-blog-posts');
                return false;
            }
        }

        if($this->request->has('can_edit'))
        {
            if($this->request->can_edit == 1) {
                 $user->givePermissionTo('edit-blog-posts');
                 return true;
            }else{
                $user->revokePermissionTo('edit-blog-posts');
                return false;
            }
        }

        if($this->request->has('can_delete'))
        {
            if($this->request->can_delete == 1) {
                 $user->givePermissionTo('delete-blog-posts');
                 return true;
            }else{
                $user->revokePermissionTo('delete-blog-posts');
                return false;
            }
        }
    }
}