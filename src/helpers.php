<?php

use AlexanderPoellmann\LaravelZendesk\Zendesk;

function zendesk(): Zendesk
{
    return app(Zendesk::class);
}
