<x-app-layout title="Todo Details">
    <div class="container mx-auto p-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold mx-auto">Todo Details</h1>
            <a href="{{ route('todos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Back</a>
        </div>

        <div class="mt-6 bg-white shadow-md rounded-md p-6">
            <h2 class="text-lg font-semibold">{{ $todo->title }}</h2>
            <p class="text-gray-500 mt-2">{{ $todo->description }}</p>
            <p class="mt-4"><strong>Status:</strong> {{ $todo->is_completed ? 'Completed' : 'Pending' }}</p>
        </div>
    </div>
</x-app-layout>