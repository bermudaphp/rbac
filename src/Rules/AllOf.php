<?php

namespace Bermuda\RBAC\Rules;

use Bermuda\RBAC\ActorInterface;
use Bermuda\RBAC\RoleInterface;

final class AllOf implements RuleInterface, PermissionAwareInterface
{
    use RulesTrait;

    public function can(ActorInterface|RoleInterface $actor, object $context = null): bool
    {
        foreach ($this->rules as $rule) {
            if (!$rule->can($actor, $context)) return false;
        }

        return true;
    }
}
