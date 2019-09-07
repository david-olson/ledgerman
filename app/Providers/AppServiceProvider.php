<?php

namespace App\Providers;

use App\Score;
use App\Result;

use Illuminate\Support\ServiceProvider;

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
        Score::updated(function($score) {
            $score->result->setWinnerMeta();
        });

        Score::created(function($score) {
            $score->createMeta();
            $score->result->setWinnerMeta();
        });

        Result::updated(function($result) {
            $result->setWinnerMeta();
        });

        Result::created(function($result) {
            $result->setWinnerMeta();
        });
    }
}
