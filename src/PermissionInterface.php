<?php

namespace App\Entity;

interface PermissionInterface
{
    public function can(?array $context = null): bool ;
    public function is(string|array $permissionID): bool ;
}