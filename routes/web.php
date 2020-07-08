<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

Auth::routes();

Route::middleware(['auth'])->group(
    function () {
        Route::get('/home', 'HomeController@index')->name('home');
    }
);

Route::middleware(['admin.or.manager'])->group(
    function () {
        Route::get('users/{user}/edit_type', 'UsersController@editType')->name('users.edit_type');
        Route::put('users/{user}/update_type', 'UsersController@updateType')->name('users.update_type');

        Route::resources(
            [
                'rates' => 'RatesController',
                'feedback_subjects' => 'FeedbackSubjectsController',
                'room_statuses' => 'RoomStatusesController',
                'user_types' => 'UserTypesController',
                'users' => 'UsersController',

            ]
        );
    }
);

Route::middleware(['auth', 'authorise'])->group(
    function () {
        Route::resources(
            [
                'profiles' => 'ProfilesController'
            ]
        );
    }
);
