@extends('app')

@section('content')
<div class="container">
    <h2>Gestion des catégories</h2>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">➕ Nouvelle catégorie</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('categories.edit', $c) }}" class="btn btn-warning btn-sm">✏ Modifier</a>
                    <form action="{{ route('categories.destroy', $c) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">🗑 Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4">Aucune catégorie</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
