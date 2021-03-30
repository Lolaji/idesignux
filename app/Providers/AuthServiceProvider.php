<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        $checkSetting = function(User $user, $settingObj) {
            if (!is_null($settingObj) && !$settingObj->is_published) {
                return $user->is_admin;
            }
            return true;
        };

        Gate::define('admin', function (User $user) {
            return $user->is_admin;
        });

        Gate::define('view-post', function (User $user, Blog $post) {
            if ($post->visibility == 'private') {
                return $user->id === $post->user->id;
            }
            return true;
        });

        Gate::define('view-portfolio', function (User $user, Portfolio $portfolio) use ($checkSetting) {
            return $checkSetting($user, $portfolio->settings);
        });

        Gate::define('view-service', function (User $user, Service $service) use ($checkSetting) {
            return $checkSetting($user, $service->settings);
        });
    }
}
