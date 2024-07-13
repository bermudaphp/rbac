<?php

namespace Bermuda\RBAC;

class ConfigProvider extends \Bermuda\Config\ConfigProvider
{
    public const string CONF_RULES_KEY = 'Bermuda\RBAC_RULES';

    protected function getAliases(): array
    {
        return [AccessControl::class => Guard::class];
    }

    protected function getFactories(): array
    {
        return [Guard::class => GuardFactory::class];
    }
}
