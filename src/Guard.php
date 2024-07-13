<?php

namespace Bermuda\RBAC;

use Bermuda\RBAC\Rules\RuleMode;
use Bermuda\RBAC\Rules\RuleInterface;
use Bermuda\RBAC\Rules\PermissionAwareInterface;

final class Guard implements AccessControl
{
    /**
     * @var RuleInterface[]
     */
    private array $rules = [];

    /**
     * @param iterable<string, RuleInterface> $rules
     */
    public function __construct(iterable $rules = [])
    {
        foreach ($rules as $p => $rule) $this->addRule($p, $rule);
    }

    public function enforce(string $permission, ActorInterface|RoleInterface $actor, object $context = null): bool
    {
        $role = $actor instanceof ActorInterface ? $actor->getRole() : $actor;
        if (($rule = $this->rules[$permission] ?? null) !== null) {
            if ($rule instanceof PermissionAwareInterface) $rule->setPermission($permission);
            switch ($rule->mode()) {
                case RuleMode::with:
                    return $role->has($permission) && $rule->can($actor, $context);
                case RuleMode::without:
                    return !$role->getRole()->has($permission) && $rule->can($actor, $context);
                case RuleMode::ever:
                    return $rule->can($actor, $context);
            }
        }

        return $role->has($permission);
    }

    /**
     * @param string[] $permissions
     */
    public function enforceAny(array $permissions, ActorInterface|RoleInterface $actor, object $context = null): bool
    {
        foreach ($permissions as $permission) {
            $result = $this->enforce($permission, $actor, $context instanceof ContextAggregator
                ? $context->get($permission) : $context
            );

            if ($result) return true;
        }

        return false;
    }

    /**
     * @param iterable<string, RuleInterface> $rules
     * @return Guard
     */
    public function withRules(iterable $rules): Guard
    {
        return new self($rules);
    }

    private function addRule(string $permission, RuleInterface $rule): void
    {
        $this->rules[$permission] = $rule;
    }
}
