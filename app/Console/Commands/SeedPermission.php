<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

class SeedPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '填充权限';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 获取 zh-CN 语言包中的权限下所有文件
        $files = Storage::disk('root')->files(resource_path('lang/zh-CN/permission'));

        try {
            is_null(!$files);
        } catch (\Exception $e) {
            report($e);
            return false;
        }

        DB::transaction(function () use ($files) {
            foreach ($files as $file) {
                // 获取守卫名称
                $guardName = basename($file, '.php');
                $array = include(resource_path('lang/zh-CN/permission/') . $guardName . '.php');

                $values = [];
                foreach ($array as $arr) {
                    $values[] = $arr['value'];
                    if (isset($arr['children']) && is_array($arr['children'])) {
                        foreach ($arr['children'] as $child) {
                            $values[] = $child['value'];
                        }
                    }
                }
                // 获取数据库中的权限
                $permissions = Permission::select('name')
                    ->where('guard_name', $guardName)
                    ->get()
                    ->pluck('name');
                // 筛选出不同的权限
                $diff = collect($values)->diff($permissions);
                foreach ($diff as $item) {
                    Permission::create(['name' => $item, 'guard_name' => $guardName]);
                }
                // 反向删除
                $diff2 = collect($permissions)->diff($values);
                foreach ($diff2 as $item) {
                    Permission::where(['name' => $item, 'guard_name' => $guardName])->delete();
                }
            }
        });

        $this->info('权限已更新');
    }
}
