<?php

namespace Bermuda\RBAC;

final class Permission implements \Stringable, PermissionInterface
{
    /**
     * @var iterable<RoleTrait>
     */
    public iterable $roles = [];

    public function __construct(
        public readonly string $id
    ) {
    }


    public function __toString(): string
    {
        return $this->id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
