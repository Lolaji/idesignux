<?php

namespace App\Http\Middleware;

use App\Models\Preference;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class Maintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $site_settings = Preference::settings('site_setting')->settings;

        if (!is_null($site_settings) && $site_settings->maintenance->in_maintenance) {
            if (!Gate::allows('admin')) {
                return redirect('/maintenance');
            }
        }

        return $next($request);
    }
}
