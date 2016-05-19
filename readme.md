# App service config loader
Used to load app config, and register the alias and providers, based on environment or custom config by custom usage. In default looks only for local config `app_local.php`. You can enable
loading of config based on the current environment (checks if config exists then loads it). More in `AppServiceProvider` and `AppEnvironmentTrait` docs.

## Config structure
The structure of the config is same like basic app config and should be named with app prefix and the name of the environment: `app_{environment}`
The loader supports `alias` and `providers` keys.

### Name examples

* app_local.php
* app_production.php

## AppSeviceProvider
The default implementation that looks for local config only.  Uses the `AppEnvironmentTrait`

### Enable environment config load
Extend the register (and set before parent call) or construct method and set `$checkOnlyLocalEnvironment` property to false.

    public function __construct() {
        $this->checkOnlyLocalEnvironment = false;
    }

## Example
It's important that you dont implement register 

    use Pion\Laravel\EnvironmentConfig\AppServiceProvider as BaseAppServiceProvider;
    
    class AppServiceProvider extends BaseAppServiceProvider {
    
    }

## AppEnvironmentTrait
Enables on demand loading of the config with provided the app instance and the name of the config name (without the prefix!).
Uses the context of the app ($this->app) in the AppServiceProvider. All methods are protected.

### loadAndRegister($checkOnlyLocal = true)
Tries to load the local config or if you pass false as first parametr it will try to load the config based on the current
environment.

### registerFromEnvironment($environment)
Registers the desired config (pass only name).

## AppServiceConfigLoaderTrait
Enables loading custom config files and registers the aliases and providers by providing the config name and the app context. All methods are protected.

### registerFromConfig($configName, $app)
Registers the aliases and providers.

### registerProviders(array $providers, $app)
Registers the providers array into the app.

### registerAliases(array $aliases, $app)
Registers the aliases array into the app.