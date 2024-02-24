<?php

namespace Bermuda\RBAC;

class ConfigProvider extends \Bermuda\Config\ConfigProvider
{
    protected function getAliases(): array
    {
        return [AccessControl::class => Guard::class];
    }

    protected function getInvokables(): array
    {
        return [AccessControl::class];
    }
}
