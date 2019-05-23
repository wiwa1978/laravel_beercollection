<?php

namespace App\Providers;

use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;

use App\Nova\Metrics\ItemsPerDay;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\NewBeeritems;
use App\Nova\Metrics\NewBreweries;
use App\Nova\Metrics\NewCategories;
use App\Nova\Metrics\NewCollections;
use App\Nova\Metrics\NewTags;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                'wauters1978@gmail.com'
            ]);
        });

        /**
         *
         * Gate::define('viewNova', function ($user) {
         * return $user->hasAnyRole(['Admin', 'Content Editor']);
        * });
         */


    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new NewUsers,
            new NewBeeritems,
            new NewBreweries,
            new NewCategories,
            new NewCollections,
            new NewTags,
            //new ItemsPerDay,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            \Vyuldashev\NovaPermission\NovaPermissionTool::make(),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
