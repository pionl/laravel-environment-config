<?php
namespace Pion\Laravel\EnvironmentConfig;

use Illuminate\Support\ServiceProvider;
use Pion\Laravel\EnvironmentConfig\Traits\AppEnvironmentTrait;

/**
 * Class AppServiceProvider
 *
 * Default usage of the service provider
 *
 * @package Pion\Laravel\EnvironmentConfig
 */
class AppServiceProvider extends ServiceProvider
{
    use AppEnvironmentTrait;

    /**
     * Enables only loading config for local environment. On false enables loading via env. name
     * @var bool
     */
    protected $checkOnlyLocalEnvironment = false;
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadAndRegister($this->checkOnlyLocalEnvironment);
    }
}