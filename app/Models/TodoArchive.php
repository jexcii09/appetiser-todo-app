<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Laravel\Sanctum\HasApiTokens;

class TodoArchive extends Model
{
    use HasFactory, HasApiTokens;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['user_id', 'details'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function details(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => json_decode($value, false),
        );
    }
}
