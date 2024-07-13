<?php

namespace Bermuda\RBAC\Rules;

trait RulesTrait
{
    private array $rules = [];

    /**
     * @param iterable<RuleInterface> $rules
     */
    public function __construct(iterable $rules)
    {
        foreach ($rules as $rule) $this->add($rule);
    }

    private function add(RuleInterface $rule): void
    {
        $this->rules[] = $rule;
    }
}