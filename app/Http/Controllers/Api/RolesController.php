<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\RoleRequest;
use App\Http\Resources\RoleResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * 列表
     *
     * @param Request $request
     * @param Role $role
     * @return mixed
     */
    public function index(Request $request, Role $role)
    {
        // 默认 20 页
        $limit = $request->has('limit') ? $request->limit : 20;

        // 获取当前守卫名称
        $guardName = Guard::getDefaultName(self::class);
        $roles = $role->where('guard_name', $guardName)->paginate($limit);
        return RoleResource::collection($roles);
    }

    /**
     * 详情
     *
     * @param $role
     * @return RoleResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($role)
    {
        $this->authorizeForUser(Auth::guard('api')->user(), 'authorize', $role);
        return new RoleResource($role);
    }

    /**
     * 新增
     *
     * @param RoleRequest $request
     * @param Role $role
     * @return RoleResource
     */
    public function store(RoleRequest $request, Role $role)
    {
        $names = User::getAllowedRoleNames();
        $role = $role::create($request->only($names));
        return new RoleResource($role);
    }

    /**
     * 修改
     *
     * @param RoleRequest $request
     * @param Role $role
     * @return RoleResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(RoleRequest $request, Role $role)
    {
        $this->authorizeForUser(Auth::guard('api')->user(), 'authorize', $role);
        $names = User::getAllowedRoleNames();
        $role->update($request->only($names));
        return new RoleResource($role);
    }

    /**
     * 删除
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        $this->authorizeForUser(Auth::guard('api')->user(), 'authorize', $role);
        $role->delete();
        return response()->noContent();
    }

    /**
     * 给角色添加权限
     *
     * @param RoleRequest $request
     * @param Role $role
     * @return RoleResource
     */
    public function syncPermissions(RoleRequest $request, Role $role)
    {
        $role->syncPermissions($request->permissions);
        return new RoleResource($role);
    }
}
