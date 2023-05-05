<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Role;

class RoleServiceProvider extends ServiceProvider
{

    
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'writer']);
        Role::firstOrCreate(['name' => 'user']);

    }
}
