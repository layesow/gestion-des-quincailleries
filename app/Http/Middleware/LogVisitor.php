<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitor;

class LogVisitor
{
    public function handle($request, Closure $next)
    {
        Visitor::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent')
        ]);

        return $next($request);
    }
}