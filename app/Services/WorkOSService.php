<?php

namespace App\Services;

use WorkOS\WorkOS;

class WorkOSService
{
    public function client()
    {
        return new WorkOS(env('WORKOS_API_KEY'));
    }
}