<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [HomeController::class, 'index']);
Route::get('home', [HomeController::class, 'index']);
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('verify_login', [LoginController::class, 'verify_login']);
Route::get('logout', [LoginController::class, 'logout']);
Route::get('register', [RegisterController::class, 'index']);
Route::post('register_new_users', [RegisterController::class, 'store_new_users']);
Route::get('forgot', [ForgotPasswordController::class, 'index']);
Route::post('forgot_password', [ForgotPasswordController::class, 'forgot_password']);

Route::get('contact_us', [CmsController::class, 'index']);
Route::post('send_email', [CmsController::class, 'send_email']);
Route::get('about_us', [CmsController::class, 'about_us']);
Route::get('faqs', [CmsController::class, 'faqs']);
Route::get('privacy_policy', [CmsController::class, 'privacy_policy']);
Route::get('terms_of_conditions', [CmsController::class, 'terms_of_conditions']);
Route::get('blog', [CmsController::class, 'blog']);
Route::get('blog-detail/{slug}', [CmsController::class, 'blog_detail']);

Route::group(['middleware' => ['auth']], function () {
	Route::get('membership', [CmsController::class, 'membership']);

	Route::get('profile', [UserController::class, 'index']);
	Route::get('edit_profile', [UserController::class, 'edit']);
	Route::post('update_profile', [UserController::class, 'update']);
	Route::get('change_password', [UserController::class, 'change_password']);
	Route::post('update_password', [UserController::class, 'update_password']);
	Route::post('upload_profile_image', [UserController::class, 'upload_profile_image']);
	Route::get('my_photos', [UserController::class, 'my_photos']);
	Route::post('upload_photos', [UserController::class, 'upload_photos']);
	Route::post('delete_photos', [UserController::class, 'delete_photos']);
	Route::get('public_profile/{unique_id}', [UserController::class, 'public_profile']);
	Route::get('members', [UserController::class, 'members']);
	Route::post('add_remover_user_configuration', [UserController::class, 'add_remover_user_configuration']);
	Route::post('like_user_photos', [UserController::class, 'like_user_photos']);

	Route::get('user_membership', [UserController::class, 'user_membership']);
	Route::get('favorites', [UserController::class, 'favorites']);
	Route::get('privacy_settings', [UserController::class, 'privacy_settings']);
	Route::post('update_user_privacy_settings', [UserController::class, 'update_user_privacy_settings']);
	Route::post('visit_profile', [UserController::class, 'visit_profile']);
	Route::get('requests', [UserController::class, 'requests']);
	Route::get('chat', [UserController::class, 'chat']);
	Route::post('save_chats', [UserController::class, 'save_chats']);
	Route::post('get_chats', [UserController::class, 'get_chats']);
	Route::post('update_delete_notifications', [UserController::class, 'update_delete_notifications']);
	Route::post('delete_account', [UserController::class, 'delete_account']);
	Route::post('delete_user_chats', [UserController::class, 'delete_user_chats']);
});

require 'admin.php';