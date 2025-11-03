@extends("base")

@section('title', "se connecter")

@section('content')
<div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md mt-45">
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Erreur !</strong>
            <span class="block sm:inline">{{ $errors->first() }}</span>
        </div>
    @endifb

    <form action="{{route('login.submit')}}" method="post" class="mt-6">

        @csrf

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="enail" name="email" value="{{old('email')}}" class="mt-1 p-3 w-full border border-gray-300 outline-none rounded-md shadow-md">
            @error('email')
                <span class="text-red-500 text-sm">{{$message}}</span>
            @enderror

        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" value="{{old('password')}}" class="mt-1 p-3 w-full border border-gray-300 outline-none rounded-md shadow-md">
            @error('password')
                <span class="text-red-500 text-sm">{{$message}}</span>
            @enderror

        </div>
        <button type="submit" class="py-2 px-4 bg-purple-700 hover:bg-purple-500 text-white rounded-md">se connecter</button>

        <p>
            Pas de compte ?
            <a href="{{route('register')}}" class="text-red-500">s'inscrire des maintenant</a>
        </p>


    </form>

</div>


@endsection

