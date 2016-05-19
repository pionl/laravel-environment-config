<?php
namespace Pion\Laravel\EnvironmentConfig\Traits;

/**
 * Trait AppEnvironmentTrait
 *
 * Enables registering providers and alias from config based on environment.
 *
 *
 * @property \Illuminate\Contracts\Foundation\Application app
 *
 * @package Pion\Laravel\EnvironmentConfig\Traits
 */
trait AppEnvironmentTrait
{
    use AppServiceConfigLoaderTrait;

    /**
     * The config prefix used for storing config
     * @var string
     */
    protected $configPrefix = "app_";

    /**
     * Loads the config and registers the aliases and providers based on environment. Support custom config per
     * environment (pass $checkOnlyLocal false to enable it)
     *
     * @param bool $checkOnlyLocal enables only loading config for local environment. On false enables loading via env. name
     */
    protected function loadAndRegister($checkOnlyLocal = true)
    {
        // check if config exists

        if ($checkOnlyLocal) {
            if ($this->app->environment("local")) {
                $this->registerFromEnvironment("local");
            }
            return;
        }

        // check if there is environment config and load it
        if (Config::has($this->app->environment())) {
            $this->registerEnvironment($this->app->environment);
        }
    }

    /**
     * Registers the environment (providers and aliases)
     *
     * @param string $environment
     *
     * @return $this
     */
    protected function registerFromEnvironment($environment)
    {
        $this->registerFromConfig($this->configPrefix.$environment, $this->app);

        return $this;
    }
}