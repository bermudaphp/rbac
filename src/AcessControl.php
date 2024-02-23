<?php

namespace Bermuda\RBAC;

interface AccessControl
{
    public function can(string|array $permissionID, ?array $context = null): bool ;
}
