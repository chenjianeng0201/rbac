<?php

namespace App\Http\Middleware;

use Closure;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 是否设置语言参数，没有的情况下默认使用中文
        $language = $request->has('language') ? $request->language : 'zh-CN';
        app()->setLocale($language);
        return $next($request);
    }
}
