<?php

use Illuminate\Support\Facades\Route;

/*En el RouteServiceProvider ya ha sido definido el prefijo "admin" para todas las rutas declaradas en este archivo*/
Route::get('/',[\App\Http\Controllers\Admin\HomeController::class,'index'])->middleware('can:admin.home')->name('admin.home');
Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->names('admin.categories');

Route::resource('tags',\App\Http\Controllers\Admin\TagController::class)->names('admin.tags');

Route::resource('posts',\App\Http\Controllers\Admin\PostController::class)->names('admin.posts');

Route::resource('users',\App\Http\Controllers\Admin\UserController::class)
    ->only('index','edit','update')//Cuando se desea especificar sólo unos métodos a utilizar y no todos.
    ->names('admin.users');

Route::resource('roles',\App\Http\Controllers\Admin\RoleController::class)->names('admin.roles');
