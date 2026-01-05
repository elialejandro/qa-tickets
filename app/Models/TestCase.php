<?php

namespace App\Models;

use App\Enums\TestCase\Priority;
use App\Enums\TestCase\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestCase extends Model
{
    protected $casts = [
        'priority' => Priority::class,
        'status' => Status::class,
    ];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
