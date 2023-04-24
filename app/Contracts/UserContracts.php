<?php

namespace App\Contracts;

interface UserContracts
{
    public function userRegistration($request);

    public function userLogin();

    public function forgotPassword();

    public function loadResetPassword();

    public function resetPassword();

    public function logout();

    public function setProfile();
    
    public function getProfileView();

    public function profileupdate();

    public function userProfileView(string $id);

    public function userPendingTaskList();

    public function commentAprrove();

    public function changePassword();

    public function deleteUserAccount();
}