@extends('layout')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Add New Ad</h1>

    <form method="POST" action="{{ route('ads.store') }}">
        @csrf

        <!-- Title -->
        <div class="mb-4">
            <label class="block text-gray-700">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none">
            @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label class="block text-gray-700">Description</label>
            <textarea name="description" required
                      class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Price -->
        <div class="mb-4">
            <label class="block text-gray-700">Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" required
                   class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none">
            @error('price')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone Number -->
        <div class="mb-4">
            <label class="block text-gray-700">Phone Number</label>
            <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                   class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none">
            @error('phone_number')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
            Save
        </button>
    </form>

    <a href="{{ route('ads.index') }}" class="text-blue-600 mt-4 inline-block hover:underline">Back to list</a>
</div>
@endsection
