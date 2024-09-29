<?php

namespace App\Models;

use App\Events\TodoCompleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'is_completed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_completed', false);
    }

    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtolower($value);
    }

    public static function boot()
    {
        parent::boot();

        static::updated(function ($todo) {
            if ($todo->is_completed) {
                event(new TodoCompleted($todo));
            }
        });
    }
}
