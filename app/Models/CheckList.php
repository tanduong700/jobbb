<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CheckList extends Model
{
    use HasFactory;

    protected $fillable = ['value', 'date','task_id', 'specification_id'];

    public function specification(): BelongsTo
    {
        return $this->belongsTo(Specification::class);
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
