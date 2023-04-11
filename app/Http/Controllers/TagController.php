<?php

namespace App\Http\Controllers;

use App\Contracts\TagContracts;
use App\Models\Tag;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function __construct(Request $request, TagContracts $userContracts)
    {
        $this->request = $request;
        $this->repo = $userContracts;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.tags');
    }

    public function tagList(){
        $data = $this->repo->tagList();
        return response()->json([
            'status' => 'success',
            'data' => $data['data'],
            "meta" => $data['meta']
        ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        try{
            $user_id = Session('id');
            $validator = Validator::make(
                $this->request->all(),
                [
                    'tagname' => 'string|required|max:50|',Rule::unique('tags')->where(function ($query) use ($user_id) {
                        $query->where('user_id','==',$user_id);
                    })],

                [
                    'tagname.string' => "Please enter valid Name",
                ]
            );

            if (!$validator->passes()) {
                return response()->json(['status' => 'error', 'data' => $validator->errors()]);
            } else {
                
                $data = $this->repo->store();
                if (!empty($data)) {
                    return response()->json(['status' => 'success', 'data' => 'Tag added']);
                } else {
                    return response()->json(['error' => 'Error in Adding Tag ']);
                }
            }
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $data = $this->repo->edit($id);
            return response()->json(['status'=>'success','data' => $data['tagname']]);
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        
        try{
            $validator = Validator::make(
                $this->request->all(),
                [
                    'tagname' => 'string|required|max:50',
                ],
                [
                    'tagname.string' => "Please enter valid Name",
                ]
            );

            if (!$validator->passes()) {
                return response()->json(['status' => 'error', 'data' => $validator->errors()]);
            }
            else{
                $status = $this->repo->update($id);
                if($status){
                    return response()->json(['status' => 'success','data' => 'Tag Updated successfully']);
                }else{
                    return response()->json(['status' => 'error','data' => "Couldn't updated Tag"]);
                }
            }
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $status = $this->repo->destroy($id);
            if($status){
                return response()->json(['status'=>'success','data' => 'Tag deleted']);
            }else{
                return response()->json(['status'=>'error','data' => 'Tag not deleted']);
            }
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }
}
