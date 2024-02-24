<?php

namespace RBAC;

use Bermuda\Stdlib\Arrayable;
use Doctrine\Common\Collections\Collection;
use Entity\User\User;

class Role implements Arrayable, RoleInterface
{
    public ?int $id = null;
    public ?string $name = null;
    public ?int $hierarchy = null;
    public ?int $description = null;

    /**
     * @var Collection<User>|null
     */
    public ?Collection $users = null;

    /**
     * @var Collection<Permission>|null
     */
    public ?Collection $permissions = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getHierarchy(): int
    {
        return $this->hierarchy ?? -1 ;
    }

    public function toArray(): array
    {
        return ['id' => $this->id, 'name' => $this->name, 'hierarchy' => $this->hierarchy];
    }

    /**
     * @return iterable<PermissionInterface>
     */
    public function getPermissions(): iterable
    {
        return $this->permissions ?? [];
    }

    public function getPermissionsMask(): int
    {
        $mask = 0;
        foreach ($this->permissions as $permission) $mask |= $permission->code;

        return $mask;
    }
}