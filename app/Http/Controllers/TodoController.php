<?php

namespace App\Http\Controllers;

use App\Events\TodoNotificationEvent;
use App\Jobs\SendTodoNotification;
use App\Notifications\TodoNotification;
use App\Services\TodoService;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    protected $service;

    /**
     * Inject the TodoService into the controller.
     * 
     * @param TodoService $service
     */
    public function __construct(TodoService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the todos.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $todos = $this->service->getAllTodos();
        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new todo.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created todo in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'boolean',
        ]);

        $data['user_id'] = auth()->id();
        $todo = $this->service->createTodo($data);

        // Using the notification system
        $user = auth()->user();
        $user->notify(new TodoNotification($todo, 'created'));

        // Dispatch the job to send a notification that a todo was created
        SendTodoNotification::dispatch($todo, 'created');
        // Fire the event
        event(new TodoNotificationEvent($todo, 'created'));

        return redirect()->route('todos.index')->with('success', 'Todo created successfully!');
    }

    /**
     * Display the specified todo.
     * 
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $todo = $this->service->getTodoById($id);
        return view('todos.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified todo.
     * 
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $todo = $this->service->getTodoById($id);
        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified todo in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'boolean',
        ]);
        $data['is_completed'] = $data['is_completed'] ?? 0;

        $data['user_id'] = auth()->id();
        $todo = $this->service->updateTodo($id, $data);

        // Dispatch the job to send a notification that a todo was updated
        SendTodoNotification::dispatch($todo, 'updated');
        // Using the notification system
        $user = auth()->user();
        $user->notify(new TodoNotification($todo, 'updated'));

        // Fire the event
        event(new TodoNotificationEvent($todo, 'updated'));

        return redirect()->route('todos.index')->with('success', 'Todo updated successfully!');
    }

    /**
     * Remove the specified todo from storage.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->service->deleteTodo($id);

        return redirect()->route('todos.index')->with('success', 'Todo deleted successfully!');
    }
}
