<x-app-layout title="Create Todo">
    <div class="container mx-auto p-8">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold mx-auto">Create Todo</h1>
            <a href="{{ route('todos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Back</a>
        </div>

        <div class="bg-white shadow-md rounded-md p-6">
            @include('todos.form', [
            'action' => route('todos.store'),
            'method' => 'POST',
            'buttonText' => 'Create'
            ])
        </div>
    </div>
</x-app-layout>