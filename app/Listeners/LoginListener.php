<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class LoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle($event)
    {
        $role = $event->user->roles()->first();
        if ($role && $role->slug != 'member' && !session()->has('user_permissions')) {
            $permissions = $role->permissions()->pluck('slug')->toArray();
            request()->session()->put('user_permissions', $permissions);
        }
    }
}
