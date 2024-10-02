<x-app-layout title="Todo List">

    <div class="container mx-auto p-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold mx-auto">Todo List</h1>
            <a href="{{ route('todos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Create Todo</a>
        </div>
        @if(auth()->user())
        @foreach(auth()->user()->unreadNotifications as $notification)
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mt-2" role="alert">
            <strong class="font-bold">Notification</strong>
            <span class="block sm:inline">{{ $notification->data['message'] }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <a href="{{ url('/todos/' . $notification->data['todo_id']) }}" class="text-blue-500 underline">View Todo</a>
            </span>
        </div>
        @php
        $notification->markAsRead();
        @endphp
        @endforeach
        @endif
        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
            <ul class="divide-y divide-gray-200">
                @foreach ($todos as $todo)
                <li class="p-4 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold {{ $todo->is_completed ? 'line-through' : '' }}">{{ $todo->title }}</h2>
                        <p class="text-gray-500 {{ $todo->is_completed ? 'line-through' : '' }}">{{ $todo->description }}</p>
                    </div>
                    <div class="border-l border-gray-300 h-16 mx-4"></div>
                    <div class="flex space-x-2">
                        <a href="{{ route('todos.show', $todo->id) }}" class="text-blue-500 hover:underline">View</a>
                        <a href="{{ route('todos.edit', $todo->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>