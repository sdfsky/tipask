<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Question' => 'App\Policies\QuestionPolicy',
        'App\Models\Article' => 'App\Policies\ArticlePolicy',
        'App\Models\Answer' => 'App\Policies\AnswerPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*全局策略定义*/
        Gate::define('admin.login',  'App\Policies\AuthPolicy@adminLogin');

    }
}
