<?php

namespace App\Providers;

use Illuminate\Http\Response;
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
        //macro
        Response::macro('success', function ($message, $code = 200) {
            return \response()->json([
                'status' => 1,
                'message' => $message,
            ], $code);
        });
        Response::macro('error', function ($message, $code = 500) {
            return \response()->json([
                'status' => 0,
                'message' => $message,
            ], $code);
        });
    }
}
