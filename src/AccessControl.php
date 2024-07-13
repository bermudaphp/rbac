<?php

namespace Bermuda\RBAC;

interface AccessControl
{
    public function enforce(string $permission, ActorInterface $actor, object $context = null): bool ;
    public function enforceAny(array $permissions, ActorInterface $actor, object $context = null): bool ;
}
