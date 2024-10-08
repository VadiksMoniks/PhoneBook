<?php

namespace VadiksMoniks\PhoneBook;

use Illuminate\Support\ServiceProvider;

class PhoneBookServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'phonebook');
        
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register()
    {
      
    }
}