<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class System extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    public function specifications(): HasManyThrough
    {
        return $this->hasManyThrough(Specification::class, Device::class);
    }


    public function shifts(): BelongsToMany
    {
        return $this->belongsToMany(Shift::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
