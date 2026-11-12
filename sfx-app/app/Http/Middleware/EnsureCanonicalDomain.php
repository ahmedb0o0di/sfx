<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCanonicalDomain
{
    /**
     * Handle an incoming request.
     *
     * Ensures all requests hitting the server via direct IP (72.62.176.78),
     * insecure HTTP, or alternate subdomains (e.g. www.structurflex.ae) are
     * permanently (301) redirected to the canonical production domain:
     * https://structurflex.ae
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();

        // Allow local development without redirection
        $isLocal = in_array($host, ['localhost', '127.0.0.1', '::1'])
            || str_ends_with($host, '.test')
            || str_ends_with($host, '.local');

        if (!$isLocal) {
            $canonicalHost = 'structurflex.ae';
            $isCanonicalHost = ($host === $canonicalHost);
            $isSecure = $request->secure() || $request->header('X-Forwarded-Proto') === 'https';

            if (!$isCanonicalHost || !$isSecure) {
                $targetUrl = 'https://' . $canonicalHost . $request->getRequestUri();
                return redirect()->away($targetUrl, 301);
            }
        }

        return $next($request);
    }
}
