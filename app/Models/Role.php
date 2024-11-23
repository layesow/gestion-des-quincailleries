<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends LaratrustRole
{
    public $guarded = [];

    /* public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    } */
    public function users(){
        return $this->belongsToMany(User::class, "user_role", "role_id", "user_id");
    }
}
