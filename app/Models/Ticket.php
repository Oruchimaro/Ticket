<?php

namespace App\Models;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Observers\TicketObserver;
use App\Traits\Models\Relations\TicketRelationTrait;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([TicketObserver::class])]
class Ticket extends Model
{
    use HasFactory;
    use TicketRelationTrait;

    const EXCERPT_LENGTH = 45;

    protected $fillable = [
        'assigned_to',
        'assigned_by',
        'title',
        'description',
        'status',
        'priority',
        'comment',
        'is_resolved',
        'attachment',
    ];

    protected function casts()
    {
        return [
            'status' => TicketStatusEnum::class,
            'priority' => TicketPriorityEnum::class,
        ];
    }

    public static function scopeHigh($query)
    {
        return $query->where('priority', TicketPriorityEnum::HIGH);
    }
}
