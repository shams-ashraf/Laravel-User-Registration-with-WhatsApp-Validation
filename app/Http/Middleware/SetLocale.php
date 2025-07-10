<?php
// app/Http/Middleware/SetLocale.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
// app/Http/Middleware/SetLocale.php
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('lang')) {
            $lang = $request->lang;
            if (in_array($lang, ['en', 'ar'])) {
                app()->setLocale($lang);
                session()->put('locale', $lang);
            }
        } elseif (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        }
        
        return $next($request);
    }
}