<?php

namespace RBAC;

interface ActorInterface
{
    public function getRole(): RoleInterface ;
}