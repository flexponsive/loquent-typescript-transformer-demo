<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/** @typescript */
class OrgUnit extends Model
{
    use HasFactory;

    public function user() : HasMany
    {
        return $this->hasMany(User::class);
    }

    public function businessFunctions(): BelongsToMany {
        return $this->belongsToMany(BusinessFunction::class)->withTimestamps()->using(BusinessFunctionOrgUnit::class);
    }
}
