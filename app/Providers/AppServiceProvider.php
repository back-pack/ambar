<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
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
        Blade::include('components.form.bootstrap.input', 'input');
        Blade::include('components.form.bootstrap.custom.select', 'select');
        Blade::include('components.form.bootstrap.custom.checkbox', 'checkbox');
        Blade::include('components.form.bootstrap.checkbox-boolean', 'checkbox_boolean');
        Blade::include('components.form.bootstrap.textarea', 'textarea');
        Blade::include('components.form.bootstrap.field-errors', 'field_errors');
        Blade::include('components.nav-item', 'nav_item');
        Blade::include('components.nav-dropdown-item', 'nav_dropdown_item');
    }
}
