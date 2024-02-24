<?php

namespace RBAC;

class Permission implements \Stringable, PermissionInterface
{
    public ?int $id = null;
    public ?string $name = null;
    public ?int $code = null;

    /**
     * @var iterable<Role>
     */
    public iterable $roles = [];

    public function __toString(): string
    {
        return $this->name;
    }

    public function getCode(): int
    {
        return $this->code ?? 0;
    }

    public function getName(): string
    {
        return $this->name ?? '';
    }
}