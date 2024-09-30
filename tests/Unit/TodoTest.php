<?php

namespace Tests\Unit;

use App\Models\Todo;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class);

it('can create a todo instance', function () {
    $todo = Todo::factory()->make([
        'user_id' => User::factory()->create()->id,
        'title' => 'Learn Laravel',
        'description' => 'Study Laravel features and practices',
        'is_completed' => false,
    ]);


    //expect($todo->title)->toBe('Learn Laravel');
    expect($todo->description)->toBe('Study Laravel features and practices');
    expect($todo->is_completed)->toBeFalse();
});

it('can mark a todo as completed', function () {
    $todo = Todo::factory()->make([
        'user_id' => User::factory()->create()->id,
        'title' => 'Learn Laravel',
        'description' => 'Study Laravel features and practices',
        'is_completed' => false,
    ]);

    $todo->is_completed = true;

    expect($todo->is_completed)->toBeTrue();
});
