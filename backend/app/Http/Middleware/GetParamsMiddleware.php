<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
class GetParamsMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $params = $request->route()->parameters();
        $request->params = $params;

        $modelClass = "App\\Models\\" . ucfirst($request->params['model']);

        if (!class_exists($modelClass))
            return response('Model does not exists', 404);

        $modelRepositoryClass = 'App\\Repositories\\' . ucfirst($request->params['model']) . 'Repository';

        if (!class_exists($modelRepositoryClass))
            return response('ModelRepository does not exists', 404);

        $request->params['modelRepositoryClass'] = $modelRepositoryClass;

        return $next($request);
    }
}
