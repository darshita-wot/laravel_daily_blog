<?php

namespace App\Http\Controllers;
use App\Contracts\RatingContracts;

use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function __construct(Request $request,RatingContracts $ratingContracts)
    {
        $this->request = $request;
        $this->repo = $ratingContracts;
    }

    public function rateUser()
    {
        try{
            $rating = $this->repo->rateUser();
           
                return response()->json(['status'=>'success','data' => $rating]);
           
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }
}
