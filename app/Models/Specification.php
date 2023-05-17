<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specification extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    public function checkLists(): HasMany
    {
        return $this->hasMany(CheckList::class);
    }
}
