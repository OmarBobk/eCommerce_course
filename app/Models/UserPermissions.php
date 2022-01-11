<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserPermissions extends Model
{
    protected $guarded = [];

    public function permission(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'id', 'permission_id');
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'id', 'user_id');
    }
}
