<?php

namespace Bermuda\RBAC;

interface AccessControl
{
    public function enforce(string $permission, ActorInterface|RoleInterface $actor, object $context = null): bool ;
    public function enforceAny(array $permissions, ActorInterface|RoleInterface $actor, object $context = null): bool ;
}
