<?php

return [
    // 管理员
    [
        'value' => 'api.users.index',
        'title' => 'User',
        'children' => [
            ['value' => 'api.users.show', 'title' => 'View'],
            ['value' => 'api.users.store', 'title' => 'Add'],
            ['value' => 'api.users.update', 'title' => 'Update'],
            ['value' => 'api.users.destroy', 'title' => 'Delete'],
            ['value' => 'api.users.syncRoles', 'title' => 'Associated Role'],
        ]
    ],
    // 角色
    [
        'value' => 'api.roles.index',
        'title' => 'Role',
        'children' => [
            ['value' => 'api.roles.show', 'title' => 'View'],
            ['value' => 'api.roles.store', 'title' => 'Add'],
            ['value' => 'api.roles.update', 'title' => 'Update'],
            ['value' => 'api.roles.destroy', 'title' => 'Delete'],
            ['value' => 'api.roles.syncPermissions', 'title' => 'Association Permissions'],
        ],
    ],
    // 权限
    [
        'value' => 'api.permissions.index',
        'title' => 'Permission',
    ],
];
