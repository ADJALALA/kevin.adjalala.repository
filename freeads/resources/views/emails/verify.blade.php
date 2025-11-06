<h1>Bonjour {{ $user->name }}</h1>
<p>Merci de vous être inscrit. Cliquez sur le lien pour vérifier votre email :</p>
<a href="{{ route('verify.email', $token) }}">Vérifier mon email</a>
