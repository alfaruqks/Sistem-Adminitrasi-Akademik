<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('kurikulum', function ($user) {
            return $user->role === 'kurikulum';
        });
    
        Gate::define('guru', function ($user) {
            return $user->role === 'guru';
        });
    
        Gate::define('murid', function ($user) {
            return $user->role === 'murid';
        });
    
        Gate::define('all', function ($user) {
            return in_array($user->role, ['kurikulum', 'guru', 'murid']);
        });

        //
    }
}
