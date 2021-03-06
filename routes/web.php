<?php

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

Route::get('/', 'SiteController@index');

//Auth::routes(['register' => false]);//desabilita o registro automático, ou seja, os usuários não podem se registrar. Quando passa esse parametro com false.
Auth::routes();

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {

    Route::any('categorias/search', "CategoriaController@search")->name('categorias.search');
    Route::resource('categorias', 'CategoriaController');

    Route::any('produtos/search', 'ProdutoController@search')->name('produtos.search');
    Route::resource('produtos', 'ProdutoController');

    Route::get('/', 'DashboardController@index')->name('admin');


    Route::put('usuarios/updateRoles/{user_id}', 'UsuarioController@updateRoles')->name('usuarios.updateRoles');
    Route::get('usuarios/showRoles/{user_id}', 'UsuarioController@showRoles')->name('usuarios.showRoles');
    //primeiro a rota search, depois os resources, para todos os casos
    Route::any('usuarios/search', 'UsuarioController@search')->name('usuarios.search');
    Route::resource('usuarios', "UsuarioController");

    Route::any('permissions/search', 'PermissionController@search')->name('permissions.search');
    Route::get('permissions/removeFuncao/{permission_id}/{role_id}', 'PermissionController@removeFuncao')->name('permissions.removeFuncao');
    Route::resource('permissions', "PermissionController");

    Route::get('roles/showPermissions/{role_id}', 'RoleController@showPermissions')->name('roles.showPermissions');
    Route::put('roles/updatePermissions/{role_id}', 'RoleController@updatePermissions')->name('roles.updatePermissions');
    Route::any('roles/search', 'RoleController@search')->name('roles.search');
    Route::resource('roles', "RoleController");

    Route::any('modules/search', 'ModuleController@search')->name('modules.search');
    Route::resource('modules', 'ModuleController');

    Route::any('groups/search', 'GroupController@search')->name('groups.search');
    Route::resource('groups', 'GroupController');

    Route::get('roles-permissions', 'ProdutoController@permissions');

});