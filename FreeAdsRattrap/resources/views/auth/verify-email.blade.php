<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Vérification Email</title>
</head>
<body class="p-10">
  <h1>Vérifiez votre adresse email</h1>
  <p>Un lien de confirmation a été envoyé à {{ auth()->user()->email }}.</p>

  <form action="{{ route('verification.send') }}" method="POST">
    @csrf
    <button type="submit">Renvoyer le mail</button>
  </form>

  <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Se déconnecter</button>
  </form>
</body>
</html>
