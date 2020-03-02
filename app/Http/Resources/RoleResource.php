<?php

namespace App\Http\Resources;

use App\Admin;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        // 获取当前语言角色名称
        $data['default_name'] = $data[Admin::ROLE_NAME[app()->getLocale()]];
        return $data;
    }
}
