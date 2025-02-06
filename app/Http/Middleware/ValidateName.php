<?php
namespace App\Http\Middleware;
use Closure;
class ValidateName
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
        $name = $request->input('name');
        // Check if the URL is valid
        if (filter_var($name, FILTER_VALIDATE_URL)) {
            return $next($request);
        } else {
            return response(view('welcome', ['status' => 'Name is not valid']));
        }
    }
}