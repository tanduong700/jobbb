<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['name','system_id'];

    public function system(): BelongsTo
    {
        return $this->belongsTo(System::class);
    }

    public function specifications(): HasMany
    {
        return $this->hasMany(Specification::class);
    }

    public function checkLists(): HasManyThrough
    {
        return $this->hasManyThrough(CheckList::class, Specification::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
