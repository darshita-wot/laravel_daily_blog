<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CountController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Notifications\Newvisit;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {

    if (Auth::check()) {
        return redirect('/home');
    } else {
        return redirect('/login');
    }
});

Route::get('/notification', function () {
    $user = User::first();
    $user->notify(new Newvisit("A new user has visited on your application."));
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/registration', [UserController::class, 'userRegistration']);
Route::post('/login', [UserController::class, 'userLogin']);

Route::post('/forgotpassword', [UserController::class, 'forgotPassword']);

Route::get('/resetpassword', [UserController::class, 'loadResetPassword']);
Route::post('/resetpassword', [UserController::class, 'resetPassword']);

// Route::group(['middleware' => ['web']]);
Route::get('logout', [UserController::class, 'logout']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/myprofileview', [UserController::class, 'getProfileView']);
    Route::post('/myprofileupdate', [UserController::class, 'profileupdate']);
    Route::get('/setprofile', [UserController::class, 'setProfile']);
    Route::get('/userprofileview/{id}', [UserController::class, 'userProfileView']);
    Route::get('/mypendingtasks', [UserController::class, 'userPendingTaskView']);
    Route::post('/userpendingtasklist', [UserController::class, 'userPendingTaskList']);
    Route::post('/commentapprove', [UserController::class, 'commentAprrove']);
});

Route::group(['middleware' => ['auth', 'role_or_permission:admin|create-users|edit-users|delete-users']], function () {

    Route::get('/users', function () {
        return view('admin/users');
    });

    Route::post('/user-permission-list', [App\Http\Controllers\Admin\UserController::class, 'userPermissionList']);
    Route::post('/userlist', [App\Http\Controllers\Admin\UserController::class, 'userList']);
    Route::get('/edituser', [App\Http\Controllers\Admin\UserController::class, 'editUser']);
    Route::post('/updateuser', [App\Http\Controllers\Admin\UserController::class, 'updateUser']);
    Route::get('/userdelete', [App\Http\Controllers\Admin\UserController::class, 'deleteUser']);
    Route::post('/userstatus', [App\Http\Controllers\Admin\UserController::class, 'changeUserStatus']);

    Route::get('/permissions', function () {
        return view('admin/permissions');
    });
    Route::post('/blog-permission', [App\Http\Controllers\Admin\UserController::class, 'changeBlogPermission']);


});

Route::group(['middleware' => ['auth', 'role:admin|user']], function () {

    Route::post('/taglist', [TagController::class, 'tagList']);
    Route::resource('tags', TagController::class);

    Route::get('/blogs', [BlogController::class, 'userBlogs']);
    Route::get('/home', [BlogController::class, 'allBlogs']);

    Route::post('/upload', [BlogController::class, 'uploadBlogImg']);
    Route::post('/addblog', [BlogController::class, 'addBlog']);
    Route::get('/blog/edit/{id}', [BlogController::class, 'editBlog']);
    Route::post('/updateblog', [BlogController::class, 'updateBlog']);
    Route::get('/singleblog/{id}', [BlogController::class, 'singleBlog']);

    Route::post('/setlike', [CountController::class, 'setLike']);
    Route::post('/dislike-blog', [CountController::class, 'disLikeBlog']);

    Route::post('/blog/comment/{blog_id}', [CommentController::class, 'addComment']);

    Route::post('/followuser', [CountController::class, 'followUser']);
    Route::post('/unfollow-user', [CountController::class, 'unfollowUser']);

    Route::post('/rateuser', [RatingController::class, 'rateUser']);

    Route::post('/rateblog', [RatingController::class, 'rateBlog']);

    Route::post('/changepassword', [UserController::class, 'changePassword']);
    Route::post('/delete-user-account', [UserController::class, 'deleteUserAccount']);

});

Route::group(['middleware' => ['auth', 'permission:delete-blog-posts']], function () {
    Route::delete('/deleteblog/{id}', [BlogController::class, 'deleteBlog']);
});