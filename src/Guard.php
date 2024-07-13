<?php

namespace Bermuda\RBAC;

use Bermuda\RBAC\Rules\RuleInterface;

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
        foreach ($rules as $p => $rule) $this->associate($p, $rule);
    }

    public function enforce(string $permission, ActorInterface $actor, object $context = null): bool
    {
        $result = (bool) $this->rules[$permission]?->can($actor, $context);
        if ($actor->getRole()->has($permission) && $result) return true;

        return $result;
    }

    /**
     * @param string[] $permissions
     */
    public function enforceAny(array $permissions, ActorInterface $actor, object $context = null): bool
    {
        foreach ($permissions as $permission) {
            $result = $this->enforce($permission, $actor, $context instanceof ContextAggregator
                ? $context->get($permission) : $context
            );

            if ($result) return true;
        }

        return false;
    }

    public function associate(string $permission, RuleInterface $rule): self
    {
        $this->rules[$permission] = $rule;
        return $this;
    }
}
