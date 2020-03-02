<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 不允许跨守卫操作
     *
     * @param Role $role
     * @return bool
     */
    public function authorize($current, Role $role)
    {
        return $role->guard_name == Guard::getDefaultName(self::class);
    }
}
