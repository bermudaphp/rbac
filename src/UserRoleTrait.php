<?php

namespace Bermuda\RBAC;

trait UserRoleTrait
{
    public ?Role $role = null;

    public function can(array|string $permissionID, ?array $context = null): bool
    {
        return $this->role?->can($permissionID, $context) ?? false;
    }
}
