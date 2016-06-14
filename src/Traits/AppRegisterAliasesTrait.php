<?php
namespace Pion\Laravel\EnvironmentConfig\Traits;

use Illuminate\Foundation\AliasLoader;

/**
 * Class AppRegisterAliasesTrait
 *
 * Uses to register the aliases via the AliasLoader
 *
 * @package Pion\Laravel\EnvironmentConfig\Traits
 */
trait AppRegisterAliasesTrait
{

    /**
     * Registers the aliases
     *
     * @param array       $aliases
     *
     * @return $this
     */
    protected function registerAliases(array $aliases)
    {
        // we need to use the alias loder that will merger the new aliases
        // with current loaded aliases
        AliasLoader::getInstance($aliases)->register();
        return $this;
    }
}