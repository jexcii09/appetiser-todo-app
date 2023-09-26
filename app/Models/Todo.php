<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Laravel\Sanctum\HasApiTokens;

class Todo extends Model
{
    use HasFactory, HasApiTokens;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $fillable = ['user_id', 'name', 'description', 'due_date', 'priority_level_id', 'status_id'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function priorityLevel(): BelongsTo
    {
        return $this->belongsTo(PriorityLevel::class, 'priority_level_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }
}
