<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = ['shift'];

    public function systems(): BelongsToMany
    {
        return $this->belongsToMany(System::class);
    }

    public function checkLists(): HasMany
    {
        return $this->hasMany(checkList::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
