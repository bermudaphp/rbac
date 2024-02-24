<?php

namespace Bermuda\RBAC;

use RBAC\Exception\InvalidContextException;

interface AccessControl
{
    /**
     * @throws InvalidContextException
     */
    public function enforce(string $permission, ActorInterface $actor, ?array $context = null): bool ;
}
