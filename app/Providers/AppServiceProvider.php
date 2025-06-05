<?php
namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Blade::if('role', function (...$roles) {
            $user = Auth::user();
            return $user && isset($user->role) && in_array($user->role, $roles);
        });
    }
}
