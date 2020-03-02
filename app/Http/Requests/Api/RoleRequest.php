<?php

namespace App\Http\Requests\Api;

use App\Rules\CheckPermission;
use App\User;
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
            case 'api.roles.store':
                $rules = [];
                foreach (User::ROLE_NAME as $value) {
                    $rules[$value] = [
                        'required', 'string',
                        Rule::unique('roles')->where(function ($query) {
                            return $query->where('guard_name', Guard::getDefaultName(self::class));
                        })
                    ];
                }
                return $rules;
                break;
            case 'api.roles.update':
                $rules = [];
                foreach (User::ROLE_NAME as $value) {
                    $rules[$value] = [
                        'string',
                        Rule::unique('roles')->where(function ($query) {
                            return $query->where('guard_name', Guard::getDefaultName(self::class));
                        })->ignore($this->role->id)
                    ];
                }
                return $rules;
                break;
            case 'api.roles.syncPermissions':
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
