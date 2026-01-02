<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use App\Listeners\MergeGuestCart;
use App\View\Composers\HomeComposer;

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
        // Register view composer for home page to separate home data from services
        View::composer('home.index', HomeComposer::class);

        // Listen for login events to merge guest cart into authenticated user's cart
        Event::listen(Login::class, [MergeGuestCart::class, 'handle']);
    }
}
