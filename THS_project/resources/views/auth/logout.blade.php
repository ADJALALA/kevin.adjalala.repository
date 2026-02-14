<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="bg-yellow-700 hover:bg-yellow-800 px-4 py-2 rounded text-sm">
        <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
    </button>
</form>