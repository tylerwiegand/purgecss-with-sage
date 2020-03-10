<?php

namespace tylerwiegand\PurgecssWithSage\Providers;

use Roots\Acorn\ServiceProvider;

class PurgecssWithSageServiceProvider extends ServiceProvider
{
    /**
     * Register and compose fields.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            \tylerwiegand\PurgecssWithSage\Console\PurgecssWithSage::class,
        ]);
    }
}
