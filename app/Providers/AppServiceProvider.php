<?php

namespace App\Providers;

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
        $this->app->bind(Music::class, function($app){
            return new Music();
        });

        $this->app->bind(MusicInStore::class, function($app){
            return new MusicInStore();
        });

        $this->app->bind(Comment::class, function($app){
            return new Comment();
        });
        
    }
}
