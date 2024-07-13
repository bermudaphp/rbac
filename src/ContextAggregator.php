<?php

namespace Bermuda\RBAC;

final readonly class ContextAggregator
{
    /**
     * @var object[]
     */
    private array $contexts;

    public function __construct(array $contexts)
    {
        $this->contexts = $contexts;
    }

    public function get(string $permission):? object
    {
        return $this->contexts[$permission] ?? null;
    }
}