<?php

namespace Bermuda\RBAC;

interface RoleInterface
{
    public function getHierarchy(): int ;

    public function getName(): string ;

    /**
     * @return iterable<PermissionInterface>
     */
    public function getPermissions(): iterable ;

    /**
     * @return $this
     */
    public function associate(string|PermissionInterface $permission): RoleInterface ;

    /**
     * @return $this
     */
    public function dissociate(string|PermissionInterface $permission): RoleInterface ;

    public function has(string|PermissionInterface $permission): bool ;
}
