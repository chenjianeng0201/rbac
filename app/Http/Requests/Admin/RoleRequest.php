<?php

namespace App\Http\Requests\Admin;

use App\Admin;
use App\Rules\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Guard;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // 获取路由的名称
        $routeName = $this->route()->getName();

        switch ($routeName) {
            case 'admin.roles.store':
                $rules = [];
                foreach (Admin::ROLE_NAME as $value) {
                    $rules[$value] = [
                        'required', 'string',
                        Rule::unique('roles')->where(function ($query) {
                            return $query->where('guard_name', Guard::getDefaultName(self::class));
                        })
                    ];
                }
                return $rules;
                break;
            case 'admin.roles.update':
                $rules = [];
                foreach (Admin::ROLE_NAME as $value) {
                    $rules[$value] = [
                        'string',
                        Rule::unique('roles')->where(function ($query) {
                            return $query->where('guard_name', Guard::getDefaultName(self::class));
                        })->ignore($this->role->id)
                    ];
                }
                return $rules;
                break;
            case 'admin.roles.syncPermissions':
                return [
                    'permissions' => 'required|array',
                    'permissions.*' => [
                        'required',
                        new CheckPermission()
                    ]
                ];
                break;
        }
    }
}
