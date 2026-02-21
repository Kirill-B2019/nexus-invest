<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

/**
 * Роль с полем slug (описание).
 */
class Role extends SpatieRole
{
    protected $fillable = [
        'name',
        'guard_name',
        'slug',
    ];
}
