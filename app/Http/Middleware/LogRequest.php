<?php

namespace App\Http\Middleware;

use App\Contracts\AppReportService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogRequest
{

    public function __construct(
        private AppReportService $logger
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $this->logger->generate([
            'ip'   => $request->ip(),
            'path' => $request->path(),
        ]);

        return $next($request);
    }
}
