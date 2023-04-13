<?php

namespace App\Contracts;

interface BlogContracts
{

    public function userBlogs();
    
    public function uploadBlogImg();

    public function addBlog();

    public function allBlogs();

    public function editBlog(string $id);

    public function updateBlog();

    public function deleteBlog(string $id);
}
