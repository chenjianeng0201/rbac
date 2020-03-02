<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission;

class CheckPermission implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $permissions = Permission::where('guard_name', Guard::getDefaultName(self::class))->get()->pluck('name')->toArray();
        return in_array($value, $permissions);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // 使用语言包报错信息
        return trans('validation.custom.permission');
    }
}
