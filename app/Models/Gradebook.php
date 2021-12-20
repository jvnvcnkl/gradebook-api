<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gradebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function scopeFilterByName($query, $filter = '')
    {

        if (!$filter) {
            return $query;
        };

        return $query->where('name', 'like', "%{$filter}%");
    }
}
