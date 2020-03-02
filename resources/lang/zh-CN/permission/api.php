<?php

return [
    // 管理员
    [
        'value' => 'api.users.index',
        'title' => '用户',
        'children' => [
            ['value' => 'api.users.show', 'title' => '查看'],
            ['value' => 'api.users.store', 'title' => '添加'],
            ['value' => 'api.users.update', 'title' => '修改'],
            ['value' => 'api.users.destroy', 'title' => '删除'],
            ['value' => 'api.users.syncRoles', 'title' => '关联角色'],
        ]
    ],
    // 角色
    [
        'value' => 'api.roles.index',
        'title' => '角色',
        'children' => [
            ['value' => 'api.roles.show', 'title' => '查看'],
            ['value' => 'api.roles.store', 'title' => '添加'],
            ['value' => 'api.roles.update', 'title' => '修改'],
            ['value' => 'api.roles.destroy', 'title' => '删除'],
            ['value' => 'api.roles.syncPermissions', 'title' => '关联权限'],
        ],
    ],
    // 权限
    [
        'value' => 'api.permissions.index',
        'title' => '权限',
    ],
];
