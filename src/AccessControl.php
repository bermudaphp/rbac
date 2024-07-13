<?php

namespace Bermuda\RBAC;

use RBAC\Exception\InvalidContextException;

interface AccessControl
{
    public function enforce(string $permission, ActorInterface $actor, object $context = null): bool ;
}
