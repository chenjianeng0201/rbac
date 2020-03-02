<?php

return [
    // 管理员
    [
        'value' => 'admin.admins.index',
        'title' => 'Admin',
        'children' => [
            ['value' => 'admin.admins.show', 'title' => 'View'],
            ['value' => 'admin.admins.store', 'title' => 'Add'],
            ['value' => 'admin.admins.update', 'title' => 'Update'],
            ['value' => 'admin.admins.destroy', 'title' => 'Delete'],
            ['value' => 'admin.admins.syncRoles', 'title' => 'Associated Role'],
        ]
    ],
    // 角色
    [
        'value' => 'admin.roles.index',
        'title' => 'Role',
        'children' => [
            ['value' => 'admin.roles.show', 'title' => 'View'],
            ['value' => 'admin.roles.store', 'title' => 'Add'],
            ['value' => 'admin.roles.update', 'title' => 'Update'],
            ['value' => 'admin.roles.destroy', 'title' => 'Delete'],
            ['value' => 'admin.roles.syncPermissions', 'title' => 'Association Permissions'],
        ],
    ],
    // 权限
    [
        'value' => 'admin.permissions.index',
        'title' => 'Permission',
    ],
];
