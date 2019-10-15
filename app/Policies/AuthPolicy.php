<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthPolicy
{
    use HandlesAuthorization;

    public function adminLogin(User $user){
        return $user->hasPermission('admin.index.index');
    }

}
