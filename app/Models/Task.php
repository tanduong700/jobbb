<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Staudenmeir\EloquentHasManyDeep\Eloquent\CompositeKey;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Task extends Model
{
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = ['date', 'system_id', 'shift_id'];

    public function system(): BelongsTo
    {
        return $this->BelongsTo(System::class);
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }

    public function checklists()
    {
        return $this->hasMany(CheckList::class);
    }

    public function devices()
    {
        return $this->hasManyDeep(Device::class, [CheckList::class ,Specification::class], ['task_id','id', 'id' ], [null, 'specification_id', 'device_id'])->distinct();
    }
}
