<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(UserController::class)->as('api.')->group(function () {
        Route::get('users', 'index')->name('users.index');
});
