@extends('layout')

@section('title', 'Mon profil')

@section('content')
<div class="max-w-lg mx-auto mt-8 bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Mon Profil</h1>

    <p><strong>Nom :</strong> {{ $user->name }}</p>
    <p><strong>Email :</strong> {{ $user->email }}</p>
    <p><strong>Téléphone :</strong> {{ $user->phone_number }}</p>

    <div class="mt-4 flex space-x-2">
        <a href="{{ route('user.edit') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Modifier</a>

        <form action="{{ route('user.destroy') }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer votre compte ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Supprimer</button>
        </form>
    </div>
</div>
@endsection
