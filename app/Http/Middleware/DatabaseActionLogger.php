<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ActionLog;
class DatabaseActionLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        ActionLog::create([
            'user_id' => $request->user() ? $request->user()->id : null,
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip_address' => $request->ip(),
            'status' => $response->getStatusCode(),
            'keterangan' => 'Request logged',
            'metadata' => json_encode([
                'headers' => $request->headers->all(),
                'input' => $request->except(['password', '_token']),
            ]),
        ]);
        return $response;
    }
}
