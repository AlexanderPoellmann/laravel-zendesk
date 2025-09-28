<?php

namespace AlexanderPoellmann\LaravelZendesk\Enums;

enum UserRoles: string
{
    case EndUser = 'end-user';
    case Agent = 'agent';
    case Admin = 'admin';
}
