<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CellChurchColony extends Model
{
    use HasFactory;

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeChurch($query)
    {
        $query->where('church_id', auth()->user()->member->church_id);
    }
}
