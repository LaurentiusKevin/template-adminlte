<?php

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

Route::get('/', function () {
    return redirect('login');
});

Route::group(
    ['prefix' => 'login', 'namespace' => 'Admin', 'as' => 'auth-view-', 'middleware' => ['guest']],
    function () {
        Route::get('/','LoginController@index')->name('login');
    }
);
Route::group(
    ['prefix' => 'login/auth', 'namespace' => 'Admin', 'as' => 'auth-api-'],
    function () {
        Route::post('submit','LoginController@submit')->name('submit');
    }
);

/**
 * Admin Home
 */
Route::group(
    ['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']],
    function () {
        Route::get('/', 'DashboardController@index')->name('admin');

        /**
         * System Menu Group
         */
        Route::group(
            ['prefix' => 'system/menu-group', 'as' => 'admin.system.menu-group.'],
            function ()  {
                Route::get('/', 'SysMenuGroupController@index')->name('view.index');
                Route::post('create', 'SysMenuGroupController@create')->name('view.create');
                Route::post('edit', 'SysMenuGroupController@editIndex')->name('view.edit');

                Route::group(
                    ['prefix' => 'api'],
                    function () {
                        Route::post('submit-add', 'SysMenuGroupController@store')->name('api.submit-add');
                        Route::post('submit-edit', 'SysMenuGroupController@editSubmit')->name('api.submit-edit');
                        Route::post('submit-delete', 'SysMenuGroupController@delete')->name('api.submit-delete');
                    }
                );
            }
        );

        /**
         * System Menu
         */
        Route::group(
            ['prefix' => 'system/menu', 'as' => 'admin.system.menu.'],
            function ()  {
                Route::get('/', 'SysMenuController@index')->name('view.index');
                Route::post('create', 'SysMenuController@createIndex')->name('view.create');
                Route::post('edit', 'SysMenuController@editIndex')->name('view.edit');

                Route::group(
                    ['prefix' => 'api'],
                    function () {
                        Route::post('submit-add', 'SysMenuController@store')->name('api.submit-add');
                        Route::post('submit-edit', 'SysMenuController@editSubmit')->name('api.submit-edit');
                        Route::post('submit-delete', 'SysMenuController@delete')->name('api.submit-delete');
                    }
                );
            }
        );

        /**
         * Master Data - User Role
         */
        Route::group(
            ['prefix' => 'master-data/master-role', 'as' => 'admin.master-data.master-role.'],
            function ()  {
                Route::get('/', 'MasterRoleController@index')->name('view.index');
                Route::post('create', 'MasterRoleController@createIndex')->name('view.create');
                Route::post('edit', 'MasterRoleController@editIndex')->name('view.edit');

                Route::group(
                    ['prefix' => 'api'],
                    function () {
                        Route::post('submit-add', 'MasterRoleController@store')->name('api.submit-add');
                        Route::post('submit-edit', 'MasterRoleController@editSubmit')->name('api.submit-edit');
                        Route::post('submit-delete', 'MasterRoleController@delete')->name('api.submit-delete');
                    }
                );
            }
        );

        /**
         * Master Data - User Aplikasi
         */
        Route::group(
            ['prefix' => 'master-data/user-aplikasi', 'as' => 'admin.master-data.user-aplikasi.'],
            function ()  {
                Route::get('/', 'MasterUserController@index')->name('view.index');
                Route::post('create', 'MasterUserController@createIndex')->name('view.create');
                Route::post('edit', 'MasterUserController@editIndex')->name('view.edit');

                Route::group(
                    ['prefix' => 'api'],
                    function () {
                        Route::post('submit-add', 'MasterUserController@store')->name('api.submit-add');
                        Route::post('submit-edit', 'MasterUserController@editSubmit')->name('api.submit-edit');
                        Route::post('submit-delete', 'MasterUserController@delete')->name('api.submit-delete');
                        Route::post('submit-reset-password', 'MasterUserController@resetPassword')->name('api.submit-reset-password');
                    }
                );
            }
        );
    }
);

//Route::prefix('admin')
//    ->middleware(['auth'])
//    ->group(function () {
//        $controller = 'Admin\LoginController@';
//        $route = 'auth.view.';
//        Route::get('/', 'Admin\DashboardController@index')->name('admin');
//        Route::get('logout', $controller . 'logout')->name($route . 'logout');
//        Route::get('reset-password', $controller . 'resetPassword')->name($route . 'reset-password');
//
//        Route::group(
//            ['prefix' => 'system/menu-group'],
//            function ()  {
//                $controller = 'Admin\SysMenuGroupController@';
//                $name = 'admin.system.menu-group.view.';
//                Route::get('/', $controller . 'index')->name($name . 'index');
//                Route::post('create', $controller . 'create')->name($name . 'create');
//                Route::post('edit', $controller . 'editIndex')->name($name . 'edit');
//
//                Route::group(
//                    ['prefix' => 'api'],
//                    function () use ($controller) {
//                        $name = 'system.menu-group.api.';
//                        Route::post('submit-add', $controller . 'store')->name($name . 'submit-add');
//                        Route::post('submit-edit', $controller . 'editSubmit')->name($name . 'submit-edit');
//                        Route::post('submit-delete', $controller . 'delete')->name($name . 'submit-delete');
//                    }
//                );
//            }
//        );
//
//        Route::group(
//            ['prefix' => 'system/menu'],
//            function () {
//                $controller = 'Admin\SysMenuController@';
//                $name = 'admin.system.menu.view.';
//                Route::get('/', $controller . 'index')->name($name . 'index');
//                Route::post('create', $controller . 'create')->name($name . 'create');
//                Route::post('edit', $controller . 'editIndex')->name($name . 'edit');
//
//                Route::group(
//                    ['prefix' => 'api'],
//                    function () use ($controller) {
//                        $name = 'system.menu.api.';
//                        Route::post('submit-add', $controller . 'store')->name($name . 'submit-add');
//                        Route::post('submit-edit', $controller . 'editSubmit')->name($name . 'submit-edit');
//                        Route::post('submit-delete', $controller . 'delete')->name($name . 'submit-delete');
//                    }
//                );
//            }
//        );
//    }
//);
