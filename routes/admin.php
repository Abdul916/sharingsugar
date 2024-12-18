<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersController;
// use App\Http\Controllers\Admin\ReportedUserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MembershipsController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\PhotoChangeApprovalController;
use App\Http\Controllers\Admin\PlansController;
use App\Http\Controllers\Admin\ProfileApprovalController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'  =>  'admin'], function () {
	Route::get('/', [AdminLoginController::class, 'index']);
	Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
	Route::post('verify_login', [AdminLoginController::class, 'verify_login']);
	Route::get('logout', [AdminLoginController::class, 'logout']);

	Route::group(['middleware' => ['auth:admin']], function () {
		Route::get('admin', [AdminController::class, 'index']);
		Route::get('dashboard', [AdminController::class, 'index']);
		Route::get('change_password', [AdminController::class, 'change_password']);
		Route::post('update_password', [AdminController::class, 'update_password']);

		Route::group(['prefix' => 'users'], function () {
			Route::get('/', [UsersController::class, 'index']);
			Route::get('profile/{id}', [UsersController::class, 'view_profile']);
			Route::post('change_status', [UsersController::class, 'change_status']);
			Route::post('delete', [UsersController::class, 'destroy']);
			Route::get('reported_users', [UsersController::class, 'reported_users']);
			Route::get('view_report/{id}', [UsersController::class, 'view_report']);
			Route::post('delete_reports', [UsersController::class, 'destroy_reports']);
			Route::post('generate_password', [UsersController::class, 'generate_new_user_password']);
			Route::post('free_membership', [UsersController::class, 'free_membership']);
			Route::get('export/{format}', [UsersController::class, 'export_users']);
		});

		Route::group(['prefix' => 'posts'], function () {
			Route::get('/', [PostController::class, 'index']);
			Route::get('create', [PostController::class, 'create']);
			Route::post('store', [PostController::class, 'store']);
			Route::get('edit/{id}', [PostController::class, 'edit']);
			Route::post('update', [PostController::class, 'update']);
			Route::post('delete', [PostController::class, 'destroy']);
		});
		Route::group(['prefix' => 'categories'], function () {
			Route::get('/', [CategoryController::class, 'index']);
			Route::get('create', [CategoryController::class, 'create']);
			Route::post('store', [CategoryController::class, 'store']);
			Route::get('edit/{id}', [CategoryController::class, 'edit']);
			Route::post('update', [CategoryController::class, 'update']);
			Route::post('delete', [CategoryController::class, 'destroy']);
		});

		Route::group(['prefix' => 'memberships'], function () {
			Route::get('/', [MembershipsController::class, 'index']);
		});

		Route::group(['prefix' => 'contacts_us'], function () {
			Route::get('/', [ContactUsController::class, 'index']);
			Route::post('delete', [ContactUsController::class, 'destroy']);
		});
		// Route::group(['prefix' => 'plans'], function () {
		// 	Route::get('/', [PlansController::class, 'index']);
		// 	Route::post('store', [PlansController::class, 'store']);
		// 	Route::post('show', [PlansController::class, 'show']);
		// 	Route::post('update', [PlansController::class, 'update']);
		// 	Route::post('delete', [PlansController::class, 'destroy']);
		// });
		Route::group(['prefix' => 'emails'], function () {
			Route::get('/', [EmailController::class, 'index']);
			Route::get('create', [EmailController::class, 'create']);
			Route::post('dispatch', [EmailController::class, 'dispatch_email']);
			Route::get('show/{id}', [EmailController::class, 'show']);
		});
		Route::group(['prefix' => 'profile_approvals'], function () {
			Route::get('/', [ProfileApprovalController::class, 'index']);
			Route::get('show/{id}', [ProfileApprovalController::class, 'show']);
			Route::post('approve', [ProfileApprovalController::class, 'approve']);
			Route::post('decline', [ProfileApprovalController::class, 'decline']);
		});
		Route::group(['prefix' => 'photo_approvals'], function () {
			Route::get('/', [PhotoChangeApprovalController::class, 'index'])->name('photo_approvals');
			Route::get('show/{id}', [PhotoChangeApprovalController::class, 'show']);
			Route::post('approve', [PhotoChangeApprovalController::class, 'approve']);
			Route::post('decline', [PhotoChangeApprovalController::class, 'decline']);
		});
	});
});
