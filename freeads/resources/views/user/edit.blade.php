@extends('layout')

@section('title', 'Modifier mon profil')

@section('content')
<div class="max-w-lg mx-auto mt-8 bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Modifier mon profil</h1>

    <form action="{{ route('user.update') }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block">Nom</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border p-2 rounded">
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border p-2 rounded">
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block">Téléphone</label>
            <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="w-full border p-2 rounded">
            @error('phone_number') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Mettre à jour</button>
    </form>
</div>
@endsection
