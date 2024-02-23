<?php

namespace Bermuda\RBAC;

use Doctrine\Common\Collections\Collection;

class Permission implements \Stringable
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $description = null;

    /**
     * @var Collection<Role>|null
     */
    public ?Collection $roles = null;

    public function __toString(): string
    {
        return $this->name;
    }
}
