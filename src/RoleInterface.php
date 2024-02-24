<?php

namespace Bermuda\RBAC;

interface RoleInterface
{
    public function getHierarchy(): int ;

    /**
     * @return iterable<PermissionInterface>
     */
    public function getPermissions(): iterable ;

    public function getPermissionsMask(): int ;
}
