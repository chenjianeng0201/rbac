<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Role;

class CheckRole implements Rule
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
        $roles = Role::where('guard_name', Guard::getDefaultName(self::class))->get()->pluck('id')->toArray();
        return in_array($value, $roles);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // 使用语言包报错信息
        return trans('validation.custom.role');
    }
}
