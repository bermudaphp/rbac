<?php

namespace Bermuda\RBAC;

interface RoleInterface
{
    public function getHierarchy(): int ;

    /**
     * @return iterable<PermissionInterface>
     */
    public function getPermissions(): iterable ;

    /**
     * @return $this
     */
    public function associate(string|PermissionInterface $permissionId): RoleInterface ;

    /**
     * @return $this
     */
    public function dissociate(string|PermissionInterface $permissionId): RoleInterface ;

    public function has(string $permissionId): bool ;
}
