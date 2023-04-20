<?php

namespace App\Contracts;

interface CountContracts
{
    public function setLike();

    public function disLikeBlog();
    public function followUser();

    public function unfollowUser();

}