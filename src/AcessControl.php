<?php

namespace Bermuda\RBAC;

interface AccessControl
{
     /**
     * @param string|string[] $permissionID
     */
    public function can(string|array $permissionID, ?array $context = null): bool ;
}
