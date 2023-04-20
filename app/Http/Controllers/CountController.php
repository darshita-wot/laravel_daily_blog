<?php

namespace App\Http\Controllers;

use App\Contracts\CountContracts;
use Illuminate\Http\Request;

class CountController extends Controller
{
    public function __construct(Request $request,CountContracts $countContracts)
    {
        $this->request = $request;
        $this->repo = $countContracts;
    }

    public function setLike()
    {
        try{
            $total_like = $this->repo->setLike();
           
                return response()->json(['status'=>'success','data' => $total_like]);
           
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    public function disLikeBlog()
    {
        try{
            $total_like = $this->repo->disLikeBlog();
           
                return response()->json(['status'=>'success','data' => $total_like]);
           
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }
    public function followUser()
    {
        try{
            $total_followers = $this->repo->followUser();
           
                return response()->json(['status'=>'success','data' => $total_followers]);
           
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    public function unfollowUser()
    {
        try{
            $total_followers = $this->repo->unfollowUser();
           
                return response()->json(['status'=>'success','data' => $total_followers]);
           
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }
}
