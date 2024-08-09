<?php

namespace App\Traits\Models\Relations;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait TicketRelationTrait
{
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
