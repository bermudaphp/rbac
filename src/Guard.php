<?php

namespace Bermuda\RBAC;

final class Guard implements AccessControl
{
    /**
     * @var callable[]
     */
    private array $rules = [];

    public function enforce(string $permission, ActorInterface $actor, array $context = []): bool
    {
        $rule = $this->rules[$permission] ?? null;
        foreach ($actor->getRole()->getPermissions() as $prmssn) {
            if ($prmssn->getName() == $permission) {
                return $rule ? $rule($actor, ... $context) : true;
            }
        }

        return $rule ? $rule($actor, ... $context) : false;
    }

    public function associate(string $permission, callable $rule): void
    {
        $this->rules[$permission] = $rule;
    }
}
