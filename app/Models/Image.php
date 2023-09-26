<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['todo_id', 'file_name', 'path'];
    protected $hidden = ['created_at', 'updated_at'];
}
