<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Post ads for free.">
    <title>FREE ADD ARTICLE | Register</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('./assets/img/logo.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('./assets/img/logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('./assets/css/styles.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
          crossorigin="anonymous">
    <style>
        .login{
            background: url('{{ asset("./assets/img/images/login-new.jpeg") }}')
        }
    </style>
</head>
<body class="h-screen font-sans login bg-cover">
    <div class="container mx-auto h-full flex flex-1 justify-center items-center">
        <div class="w-full max-w-xl">
            <div class="leading-loose">
                <form action="{{ route('register.store') }}" method="POST" class="m-4 p-10 bg-white rounded shadow-xl">

                    @csrf

                    <p class="text-blue-600 text-2xl text-center font-medium">Welcome</p>
                    <p class="text-blue-800 text-lg font-medium">Register</p>
                    <div class="">
                        <label class="block text-sm text-gray-00" for="cus_name">Name</label>
                        <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded" id="cus_name" name="name" type="text" required value="{{ old('name') }}"  aria-label="Name">
                        @error('name')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-2 relative">
                        <label class="block text-sm text-gray-600" for="cus_email">Email</label>
                        <input class="w-full px-5  py-2 text-gray-700 bg-gray-200 rounded" id="cus_email" name="email" type="text" required value="{{ old('email') }}"  aria-label="Email">
                        @error('email')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-2 relative">
                        <label class=" block text-sm text-gray-600" for="cus_email">Phone Number</label>
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email" name="phone" type="text" required value="{{ old('phone') }}"  aria-label="Email">
                        @error('phone')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-2 relative">
                        <label class="text-sm block text-gray-600" for="cus_email">Password</label>
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded pr-10" id="password" name="password" type="password" required value="{{ old('password') }}"  aria-label="Email">
                        <button type="button" class="pw-toggle absolute inset-y-0 right-0 flex items-center pr-3"
                            aria-label="Afficher ou masquer le mot de passe" aria-pressed="false"
                            data-target="password" onclick="togglePassword(this)">
                    <!-- icone oeil (inline SVG) -->
                            <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                        @error('password')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-2 relative">
                        <label class="text-sm block text-gray-600" for="cus_email">Password Confirmation</label>
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded pr-10" id="password_confirmation" name="password_confirmation" type="password" required value="{{ old('password_confirmation') }}"  aria-label="Email">
                        <button type="button" class="pw-toggle absolute inset-y-0 right-0  flex items-center pr-3"
                            aria-label="Afficher ou masquer la confirmation" aria-pressed="false"
                            data-target="password_confirmation" onclick="togglePassword(this)">
                            <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>

                    <div class="mt-4">
                        <input class="px-4 py-1 w-full text-white font-bold tracking-wider bg-blue-700 rounded" type="submit" value="Register">
                    </div>
                    <a class="inline-block right-0 align-baseline font-bold text-sm text-500 hover:text-blue-800" href="{{ route('login') }}">
                        Already have an account ?
                    </a>


                </form>
            </div>
        </div>
    </div>
    <script>
        function togglePassword(btn) {
            const targetId = btn.dataset.target;
            const input = document.getElementById(targetId);
            if (!input) return;

            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            btn.setAttribute('aria-pressed', isHidden ? 'true' : 'false');

            // remplacer icône : oeil <-> oeil barré
            const svg = btn.querySelector('svg');
            if (!svg) return;

            if (isHidden) {
            // oeil barré
            svg.innerHTML = `
                <path d="M17.94 17.94A10.93 10.93 0 0 1 12 20c-7 0-11-8-11-8a20.82 20.82 0 0 1 5.05-6.36"></path>
                <path d="M1 1l22 22"></path>
            `;
            } else {
            // oeil ouvert
            svg.innerHTML = `
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            `;
            }
        }
   </script>

</body>
</html>
