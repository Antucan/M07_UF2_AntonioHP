<?php
namespace App\Http\Middleware;
use Closure;
class ValidateUrl
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
        // dd($request);
        $url = $request->input('img_url');
        // Check if the URL is valid
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return $next($request);
        } else {
            return response(view('welcome', ['status' => 'URL is not valid']));
        }
    }
}