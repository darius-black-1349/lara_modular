<?php

namespace Darius\Category\Policies;

use Darius\RolePermissions\Models\Permission;
use Darius\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
    }

}
