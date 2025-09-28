<?php

namespace AlexanderPoellmann\LaravelZendesk\Enums;

enum Priorities: string
{
    case Normal = 'normal';
    case High = 'high';
    case Low = 'low';
}
