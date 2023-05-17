<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function systems(): HasMany
    {
        return $this->HasMany(System::class);
    }

    public function devices(): HasManyThrough
    {
        return $this->hasManyThrough(Device::class, System::class);
    }
}
