<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->todoData = [
        'title' => 'New Task',
        'description' => 'Task description',
        'is_completed' => false,
    ];
});


it('can create a new todo', function () {
    Log::info($this->todoData);
    $user = User::factory()->create();
    $response = $this->actingAs($user)->withoutMiddleware()->post('/todos', $this->todoData);
    $response->assertRedirect('/todos');
    $this->assertDatabaseHas('todos', [
        'title' => 'New Task',
    ]);
});

it('can update a todo', function () {
    $user = User::factory()->create();
    $todo = Todo::factory()->create();

    $updateData = ['title' => 'Updated Task'];

    $response = $this->actingAs($user)->withoutMiddleware()->put("/todos/{$todo->id}", $updateData);

    $response->assertRedirect('/todos');
    $this->assertDatabaseHas('todos', [
        'id' => $todo->id,
        'title' => 'Updated Task',
    ]);
});

it('can delete a todo', function () {
    $todo = Todo::factory()->create();

    $response = $this->withoutMiddleware()->delete("/todos/{$todo->id}");

    $response->assertRedirect('/todos');
    $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
});
