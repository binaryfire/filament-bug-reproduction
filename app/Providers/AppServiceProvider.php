<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Password::defaults(function () {
            return Password::min(8)
                        ->letters()
                        ->numbers()
                        ->symbols()
                        ->mixedCase();
        });

        //$this->configureViteHotReload();
    }

    /**
     * Enable Vite hot reload for development.
     */
    private function configureViteHotReload(): void
    {
        if (Vite::isRunningHot()) {
            FilamentView::registerRenderHook(
                'panels::head.start',
                fn (): string => Vite::toHtml()
            );
        }
    }
}
