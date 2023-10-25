<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/** @typescript */
class BusinessFunction extends Model
{
    use HasFactory;

    public function orgUnits(): BelongsToMany
    {
        return $this->belongsToMany(OrgUnit::class)->withTimestamps()->as("contribution")->using(BusinessFunctionOrgUnit::class);
    }
}
