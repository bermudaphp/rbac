<?php

namespace RBAC;

interface PermissionInterface
{
    public function getCode(): int ;
    public function getName(): string ;
}