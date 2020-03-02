<?php

Route::group([
    'prefix' => 'v1',
    'middleware' => ['bindings', 'locale']
], function () {
    // 登录接口
    Route::group([
    ], function () {
        // 获取 token
        Route::post('authorizations', 'AuthorizationsController@store')
            ->name('api.authorizations.store');
        // 刷新 token
        Route::put('authorizations/current', 'AuthorizationsController@update')
            ->name('api.authorizations.update');
        // 删除 token
        Route::delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('api.authorizations.destroy');
    });

    // 需要 token 验证的接口
    Route::group([
        'middleware' => [
            // 此处认证的是 admin 守卫
            'auth:api',
            'check.permissions'],
    ], function () {
        /****************************************************用户*******************************************************/
        // 列表
        Route::get('users', 'UsersController@index')
            ->name('api.users.index');
        // 查看当前用户
        Route::get('users/current/show', 'UsersController@currentShow')
            ->name('api.users.current.show');
        // 详情
        Route::get('users/{user}', 'UsersController@show')
            ->name('api.users.show');
        // 新增
        Route::post('users', 'UsersController@store')
            ->name('api.users.store');
        // 修改当前用户
        Route::patch('users/current/update', 'UsersController@currentUpdate')
            ->name('api.users.current.update');
        // 修改
        Route::patch('users/{user}', 'UsersController@update')
            ->name('api.users.update');
        // 删除
        Route::delete('users/{user}', 'UsersController@destroy')
            ->name('api.users.destroy');
        // 关联角色
        Route::post('users/{user}/syncRoles', 'UsersController@syncRoles')
            ->name('api.users.syncRoles');

        /****************************************************角色*******************************************************/
        // 列表
        Route::get('roles', 'RolesController@index')
            ->name('api.roles.index');
        // 详情
        Route::get('roles/{role}', 'RolesController@show')
            ->name('api.roles.show');
        // 新增
        Route::post('roles', 'RolesController@store')
            ->name('api.roles.store');
        // 修改
        Route::patch('roles/{role}', 'RolesController@update')
            ->name('api.roles.update');
        // 删除
        Route::delete('roles/{role}', 'RolesController@destroy')
            ->name('api.roles.destroy');
        // 关联权限
        Route::post('roles/{role}/syncPermissions', 'RolesController@syncPermissions')
            ->name('api.roles.syncPermissions');

        /****************************************************权限*******************************************************/
        // 列表
        Route::get('permissions', 'PermissionsController@index')
            ->name('api.permissions.index');
    });
});

