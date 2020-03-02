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
            ->name('admin.authorizations.store');
        // 刷新 token
        Route::put('authorizations/current', 'AuthorizationsController@update')
            ->name('admin.authorizations.update');
        // 删除 token
        Route::delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('admin.authorizations.destroy');
    });

    // 需要 token 验证的接口
    Route::group([
        'middleware' => [
            // 此处认证的是 admin 守卫
            'auth:admin',
            'check.permissions'],
    ], function () {
        /****************************************************管理员*******************************************************/
        // 列表
        Route::get('admins', 'AdminsController@index')
            ->name('admin.admins.index');
        // 查看当前用户
        Route::get('admins/current/show', 'AdminsController@currentShow')
            ->name('admin.admins.current.show');
        // 详情
        Route::get('admins/{admin}', 'AdminsController@show')
            ->name('admin.admins.show');
        // 新增
        Route::post('admins', 'AdminsController@store')
            ->name('admin.admins.store');
        // 修改当前用户
        Route::patch('admins/current/update', 'AdminsController@currentUpdate')
            ->name('admin.admins.current.update');
        // 修改
        Route::patch('admins/{admin}', 'AdminsController@update')
            ->name('admin.admins.update');
        // 删除
        Route::delete('admins/{admin}', 'AdminsController@destroy')
            ->name('admin.admins.destroy');
        // 关联角色
        Route::post('admins/{admin}/syncRoles', 'AdminsController@syncRoles')
            ->name('admin.admins.syncRoles');

        /****************************************************角色*******************************************************/
        // 列表
        Route::get('roles', 'RolesController@index')
            ->name('admin.roles.index');
        // 详情
        Route::get('roles/{role}', 'RolesController@show')
            ->name('admin.roles.show');
        // 新增
        Route::post('roles', 'RolesController@store')
            ->name('admin.roles.store');
        // 修改
        Route::patch('roles/{role}', 'RolesController@update')
            ->name('admin.roles.update');
        // 删除
        Route::delete('roles/{role}', 'RolesController@destroy')
            ->name('admin.roles.destroy');
        // 关联权限
        Route::post('roles/{role}/syncPermissions', 'RolesController@syncPermissions')
            ->name('admin.roles.syncPermissions');

        /****************************************************权限*******************************************************/
        // 列表
        Route::get('permissions', 'PermissionsController@index')
            ->name('admin.permissions.index');
    });
});
