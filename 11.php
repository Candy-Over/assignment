Middleware & Security
Create a Laravel middleware that ensures only users with an `is_admin` flag in the database can access certain routes.

===========================Answer===============================

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in and is an admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // If not admin, redirect or abort
        abort(403, 'Unauthorized');
    }
}
?>

<!-- We can register this middleware in the `app/Http/Kernel.php` file under the `$routeMiddleware` array:

protected $routeMiddleware = [
    'is_admin' => \App\Http\Middleware\IsAdmin::class,
    ......
]; -->



<!-- Now we can apply this middleware to specific routes or groups of routes in our routes/web.php file:
    
    Route::middleware(['is_admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index']);
    }); -->
