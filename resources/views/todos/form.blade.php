<form action="{{ $action }}" method="POST">
    @csrf
    @if($method === 'PUT')
    @method('PUT')
    @endif

    <div class="mb-4">
        <label for="title" class="block text-gray-700">Title</label>
        <input type="text" name="title" id="title" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" value="{{ old('title', $todo->title ?? '') }}" required>
        @error('title')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="description" class="block text-gray-700">Description</label>
        <textarea name="description" id="description" rows="4" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">{{ old('description', $todo->description ?? '') }}</textarea>
        @error('description')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="is_completed" class="inline-flex items-center">
            <input type="checkbox" name="is_completed" id="is_completed" class="form-checkbox text-blue-600" value="1" {{ old('is_completed', $todo->is_completed ?? false) ? 'checked' : '' }}>
            <span class="ml-2 text-gray-700">Mark as completed</span>
        </label>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">{{ $buttonText }}</button>
    </div>
</form>