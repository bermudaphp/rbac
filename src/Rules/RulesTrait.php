<?php

namespace Bermuda\RBAC\Rules;

trait RulesTrait
{
    private RuleMode $mode;
    private array $rules = [];

    protected string $permission;

    /**
     * @param iterable<RuleInterface> $rules
     */
    public function __construct(iterable $rules, RuleMode $mode = RuleMode::ever)
    {
        $this->mode = $mode;
        foreach ($rules as $rule) $this->add($rule);
    }

    public function setPermission(string $permission): void
    {
        $this->permission = $permission;
    }

    private function add(RuleInterface $rule): void
    {
        $this->rules[] = $rule;
    }

    public function mode(): RuleMode
    {
        return $this->mode;
    }
}