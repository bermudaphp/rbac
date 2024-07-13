<?php

namespace Bermuda\RBAC\Rules;

enum RuleMode
{
    /**
     * The rule will only work if the user has the required permission
     */
    case with;

    /**
     * The rule will only work if the user does not have the required permission
     */
    case without;

    /**
     * The rule will work anyway
     */
    case ever;
}
