<?php

namespace App\Contracts\Admin;

interface UserContracts
{
    public function userList();

    public function editUser();

    public function updateUser();

    public function deleteUser();

    public function changeUserStatus();

    public function userPermissionList();

    public function changeBlogPermission();
}