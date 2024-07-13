<?php

namespace Bermuda\RBAC\Rules;

interface PermissionAwareInterface
{
    public function setPermission(string $permission): void;
}