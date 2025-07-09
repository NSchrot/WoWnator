<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Events\ServeCommandStarting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;


class AppServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->isLocal() && $this->app->runningInConsole()) {
            Event::listen(ServeCommandStarting::class, function () {
                Artisan::call('app:create-daily-challenge', ['--force' => true]);
            });
        }
        
        View::composer('layouts.navigation', function ($view) {
            if (Auth::check()) {
                $unreadNotifications = Notification::where('user_id', Auth::id())
                    ->whereNull('read_at')
                    ->latest()
                    ->get();
                $view->with('unreadNotifications', $unreadNotifications);
            } else {
                $view->with('unreadNotifications', collect());
            }
        });
    }
}
