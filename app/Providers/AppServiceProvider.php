<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('view-kategori-beban', function (User $user) {
            // return $user->isAdmin();
            // return $user->role === 'admin';
            if ($user->isAdmin()) {
                return Response::allow();
            }
            return Response::denyAsNotFound();

            // return $user->isAdmin()
            // ? Response::allow()
            // : Response::denyAsNotFound();
            // Lebih clean ?
            // Kondisi ? nilaitrue : nilaiFalse
        });
    }
}
