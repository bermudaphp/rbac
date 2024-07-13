<?php

namespace Bermuda\RBAC;

use function Bermuda\Config\conf;

class GuardFactory
{
    public function __invoke(ContainerInterface $container): Guard
    {
        return new Guard(conf($container)->get(ConfigProvider::CONF_RULES_KEY, []));
    }
}