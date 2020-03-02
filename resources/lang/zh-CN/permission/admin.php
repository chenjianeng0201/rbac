<?php

return [
    // 管理员
    [
        'value' => 'admin.admins.index',
        'title' => '管理员',
        'children' => [
            ['value' => 'admin.admins.show', 'title' => '查看'],
            ['value' => 'admin.admins.store', 'title' => '添加'],
            ['value' => 'admin.admins.update', 'title' => '修改'],
            ['value' => 'admin.admins.destroy', 'title' => '删除'],
            ['value' => 'admin.admins.syncRoles', 'title' => '关联角色'],
        ]
    ],
    // 角色
    [
        'value' => 'admin.roles.index',
        'title' => '角色',
        'children' => [
            ['value' => 'admin.roles.show', 'title' => '查看'],
            ['value' => 'admin.roles.store', 'title' => '添加'],
            ['value' => 'admin.roles.update', 'title' => '修改'],
            ['value' => 'admin.roles.destroy', 'title' => '删除'],
            ['value' => 'admin.roles.syncPermissions', 'title' => '关联权限'],
        ],
    ],
    // 权限
    [
        'value' => 'admin.permissions.index',
        'title' => '权限',
    ],
];
