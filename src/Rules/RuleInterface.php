<?php

namespace Bermuda\RBAC\Rules;

use Bermuda\RBAC\ActorInterface;

interface RuleInterface
{
    public function can(ActorInterface $actor, object $context = null): bool;
}