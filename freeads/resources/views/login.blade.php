<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Post ads for free.">
    <title>FREE ADD ARTICLE | Login</title>
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
    <title>Login</title>
</head>
<body class="h-screen font-sans login bg-cover">
<div class="container mx-auto h-full flex flex-1 justify-center items-center">
    <div class="w-full max-w-xl">
        <div class="leading-loose">
            <form action="{{ route('login.store') }}" method="POST" class="m-4 p-10 bg-white rounded shadow-xl">

                @csrf

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                <p class="text-blue-800 text-lg font-medium">Login</p>
                <div class="mt-2">
                    <label class="block text-sm text-gray-600" for="cus_email">Email</label>
                    <input class="w-full px-5  py-2 text-gray-700 bg-gray-200 rounded" id="cus_email" name="email" type="text" required value="{{ old('email') }}"  aria-label="Email">
                    @error('email')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label class="text-sm block text-gray-600" for="cus_email">Password</label>
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email" name="password" type="password" required value="{{ old('password') }}"  aria-label="Email">
                    @error('password')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <input class="px-4 py-1 text-white font-bold tracking-wider bg-blue-700 rounded" type="submit" value="Login">
                </div>
                <div class="flex justify-between pt-1">
                    <a class="right-0 align-baseline text-blue-700 font-bold text-sm text-500 hover:text-blue-800" href="{{ route('register.form') }}">
                    Don't have an account ?
                    </a>
                    <a class="right-0 text-red-500 align-baseline font-bold text-sm text-500 hover:text-red-800" href="{{ route('password.request') }}">
                        Forgot Password?
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
</body>
</html>
