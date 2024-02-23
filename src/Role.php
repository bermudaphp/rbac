<?php

namespace Bermuda\RBAC;

use Bermuda\Stdlib\Arrayable;
use Bermuda\Stdlib\StrHelper;
use Doctrine\Common\Collections\Collection;

class Role implements Arrayable, AccessControl
{
    public ?int $id = null;
    public ?string $name = null;
    public ?int $description = null;

    /**
     * @var Collection<object>|null
     */
    public ?Collection $users = null;

    /**
     * @var Collection<Permission>|null
     */
    public ?Collection $permissions = null;

    /**
     * @param string|array $permissionID
     * @param array|null $context
     * @return bool
     */
    public function can(string|array $permissionID, ?array $context = null): bool
    {
        foreach ($this->permissions as $permission)
            if ($permission->is($permissionID)
                && $permission->can($context[$permission->name] ?? $context))
                return true;

        return false;
    }

    public function getWeight(): int
    {
        return $this->permissions?->count() ?? 0;
    }

    /**
     * @param string|string[] $roleID
     * @return bool
     */
    public function is(string|array $roleID): bool
    {
        return StrHelper::equals($this->name, $roleID);
    }

    public function toArray(): array
    {
        return ['id' => $this->id, 'name' => $this->name];
    }
}
