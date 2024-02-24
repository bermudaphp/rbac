<?php

namespace Bermuda\RBAC\Rules;

final class Chain
{
    private array $elements = [];
    
    /**
     * @param iterable<callable> $elements
     */
    public function __construct(iterable $elements)
    {
        foreach ($elements as $element) $this->add($element);
    }
    
    public function __invoke(mixed ... $context): bool
    {
        foreach ($this->elements as $callback) {
            if ($callback(... $context)) return true;
        }
        
        return false;
    }

    private function add(callable $element): void
    {
        $this->elements[] = $element;
    }
}
