<?php

namespace App\Listeners;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MarkEmailAsVerifiedOnPasswordReset
{

    public function __construct()
    {
        //
    }

    public function handle(PasswordReset $event): void
    {
        if ($event->user && !$event->user->hasVerifiedEmail()) {
            $event->user->markEmailAsVerified();
            $event->user->save();
        }
    }
}
