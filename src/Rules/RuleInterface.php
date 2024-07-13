<?php

namespace Bermuda\RBAC\Rules;

use Bermuda\RBAC\ActorInterface;
use Bermuda\RBAC\RoleInterface;

interface RuleInterface
{
    public function can(ActorInterface|RoleInterface $actor, object $context = null): bool ;
    public function mode(): RuleMode ;
}
