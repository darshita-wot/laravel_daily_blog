<?php

function getUserDetails(){

    if(Auth::check()){

        $user['name'] = Auth::user()->name;
        return $user;
    }
}

?>