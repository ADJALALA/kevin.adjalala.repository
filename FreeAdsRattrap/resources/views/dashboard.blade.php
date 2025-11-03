@extends("base")

@section('title', "dashboard")

@section('content')
<div class="p-10">
  <h1>Bienvenue, {{ auth()->user()->name }}</h1>
  <p>Email : {{ auth()->user()->email }}</p>
  <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Déconnexion</button>
  </form>
</div>
@endsection
