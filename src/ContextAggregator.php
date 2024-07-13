<?php

namespace Bermuda\RBAC;

final class ContextAggregator
{
    /**
     * @var object[]
     */
    private array $contexts;

    /**
     * @param iterable<string, object> $contexts
     */

    public function __construct(iterable $contexts)
    {
        foreach ($contexts as $p => $context) $this->setContext($p, $context);
    }

    public function get(string $permission):? object
    {
        return $this->contexts[$permission] ?? null;
    }
    
    private function setContext(string $permission, object $context): void
    {
        $this->contexts[$permission] = $context;
    }
}
