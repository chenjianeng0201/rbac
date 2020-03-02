<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * 列表
     *
     * @return array|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function index()
    {
        $permissions = trans('permission/admin', [], app()->getLocale());
        return response()->json(['data' => $permissions]);
    }
}
