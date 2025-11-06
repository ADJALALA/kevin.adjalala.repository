

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Post ads for free.">
        <title>FREE ADD ARTICLE | Reset Password</title>
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('./assets/img/logo.png') }}" />
        <link rel="icon" type="image/png" href="{{ asset('./assets/img/logo.png') }}" />
        <link rel="stylesheet" href="{{ asset('./assets/css/styles.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
            crossorigin="anonymous">
        <style>
            .login{
                background: url('{{ asset("./assets/images/reset.jpg") }}');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center center;
                background-attachment: fixed;
            }
        </style>
        <title>Reset Password</title>
    </head>
    <body class="h-screen font-sans login bg-cover">
        <div class="container mx-auto h-full flex flex-1 justify-center items-center">
            <div class="w-full max-w-xl">
                <div class="leading-loose">
                    <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow rounded">
                        <h2 class="text-lg font-semibold mb-4">Reset Password</h2>

                        {{-- Message de succès --}}
                        @if(session('success'))
                            <div class="p-2 mb-4 bg-green-100 text-green-700 rounded">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Erreurs --}}
                        @if ($errors->any())
                            <div class="p-2 mb-4 bg-red-100 text-red-700 rounded">
                                <ul class="list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                            @csrf
                            <div>
                                <label for="email" class="block mb-1 font-medium">Email Adress</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full border rounded px-3 py-2 focus:ring focus:border-blue-400">
                                    @error('email')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                            </div>

                            <button type="submit"
                                    class="w-full mt-5 bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                                Send reset link
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

