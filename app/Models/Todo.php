<?php

namespace App\Models;

use App\Events\TodoCompleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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

    /**
     * The "boot" method of the Todo model.
     *
     * This method is automatically called when the model is being booted.
     * It sets up event listeners for the model's lifecycle events.
     *
     * In this case:
     * 1. It calls the parent's boot method to maintain any existing boot logic.
     * 2. It registers an 'updated' event listener for the Todo model.
     * 3. When a Todo is updated, it checks if the 'is_completed' flag is true.
     * 4. If the todo is completed, it dispatches a TodoCompleted event.
     *
     * This allows for actions to be triggered automatically when a todo is marked as completed,
     * such as sending notifications or updating related data.
     */
    public static function boot()
    {
        parent::boot();
        Log::info('Todo model booted');
        static::updated(function ($todo) {
            if ($todo->is_completed) {
                Log::info('Todo completed event dispatched');
                event(new TodoCompleted($todo));
            }
        });
    }
}
