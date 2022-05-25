<?php

namespace Ully\Cloudstorages\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CheckStorageAccess
{

    public function handle(Request $request, Closure $next)
    {
        if (Gate::allows('access-storage', $request->storage)) {
            return $next($request, $request->user());
        }
        return abort(403);
    }
}
