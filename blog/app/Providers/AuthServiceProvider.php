<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Privatemessages;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('add-message', function ($user) {
            if($user->exists){
                return true;
            }else{
                return false;
            }
        });

        Gate::define('update-message', function ($user, Privatemessages $message) {
            return $user->id == $message->user_id;
        });
        Gate::define('delete-message', function ($user, Privatemessages $message) {
            return $user->id == $message->user_id;
        });
    }
}
