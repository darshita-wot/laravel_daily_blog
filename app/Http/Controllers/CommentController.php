<?php

namespace App\Http\Controllers;

use App\Contracts\CommentContracts;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(Request $request,CommentContracts $commentContracts)
    {
        $this->request = $request;
        $this->repo = $commentContracts;
    }

    public function addcomment($blog_id)
    {
        try{
            $data = $this->repo->addcomment($blog_id);
           
                return response()->json(['status'=>'success','data' => 'Comment added! It will approved soon']);
           
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }
}
