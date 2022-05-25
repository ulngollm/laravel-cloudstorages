<?php

namespace Ully\Cloudstorages\Middleware;

use App\Models\Storage;
use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

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
