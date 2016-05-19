<?php
namespace Pion\Laravel\EnvironmentConfig\Traits;

use \Illuminate\Contracts\Foundation\Application;

/**
 * Trait AppServiceConfigLoaderTrait
 *
 * Enables aliases and providers from given config.
 *
 * @package Pion\Laravel\EnvironmentConfig\Traits
 */
trait AppServiceConfigLoaderTrait
{
    /**
     * Checks if the config exists and loats the aliases and providers
     * @param string      $configName
     * @param Application $app
     */
    protected function registerFromConfig($configName, $app)
    {
        // checks if config exists (preloads the file for first time)
        if (\Config::has($configName)) {
            // register aliases and providers
            $this->registerConfigData($app, $configName, "aliases")
                ->registerConfigData($app, $configName, "providers");
        }

    }

    /**
     * Helper method to load given config with key and runs the correct method
     *
     * @param Application $app the application to use for loading config and register/alias etc
     * @param string $configName the name of the config to load
     * @param string $configKey the config key in the config that holds the entries to register. The key is used as a method
     *                          name with register prefix (registerConfigKey)
     *
     * @return $this
     */
    private function registerConfigData($app, $configName, $configKey)
    {
        // load the entries from config
        $array = \Config::get($configName.".".$configKey);

        // if there is data, run the method
        if (is_array($array) && count($array) > 0) {

            // build the method
            $method = "register".ucfirst($configKey);

            // call the method with the array and the app
            call_user_func_array([$this, $method], [$array, $app]);
        }

        return $this;
    }

    /**
     * Registers the providers
     *
     * @param array       $providers
     * @param Application $app
     *
     * @return $this
     */
    protected function registerProviders(array $providers, $app)
    {
        foreach ($providers as $provider) {
            $app->register($provider);
        }

        return $this;
    }

    /**
     * Registers the aliases
     *
     * @param array       $aliases
     * @param Application $app
     *
     * @return $this
     */
    protected function registerAliases(array $aliases, $app)
    {
        foreach ($aliases as $alias => $facade) {
            $app->alias($alias, $facade);
        }

        return $this;
    }
}