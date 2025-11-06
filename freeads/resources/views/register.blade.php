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
                <div class="mt-2">
                    <label class="block text-sm text-gray-600" for="cus_email">Email</label>
                    <input class="w-full px-5  py-2 text-gray-700 bg-gray-200 rounded" id="cus_email" name="email" type="text" required value="{{ old('email') }}"  aria-label="Email">
                    @error('email')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label class=" block text-sm text-gray-600" for="cus_email">Phone Number</label>
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email" name="phone" type="text" required value="{{ old('phone') }}"  aria-label="Email">
                    @error('phone')
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
                <div class="mt-2">
                    <label class="text-sm block text-gray-600" for="cus_email">Password Confirmation</label>
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email" name="password_confirmation" type="password" required value="{{ old('password_confirmation') }}"  aria-label="Email">
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

</body>
</html>
