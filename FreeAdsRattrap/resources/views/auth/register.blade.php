@extends("base")

@section('title', "inscription")

@section('content')
<div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
    @if(session('sucess'))
        <div class="bg-red-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sucess !</strong>
            <span class="block sm:inline">{{ (session('sucess')) }}</span>
        </div>
    @endif

    <form action="{{route('registration.register')}}" method="post" class="mt-6">
        <h2 class="text-x">register</h2>

        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" id="name" name="name" value="{{old('name')}}" class="mt-1 p-3 w-full border border-gray-300 outline-none rounded-md shadow-md">
            @error('name')
                <span class="text-red-500 text-sm">{{$message}}</span>
            @enderror

        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="enail" name="email" value="{{old('email')}}" class="mt-1 p-3 w-full border border-gray-300 outline-none rounded-md shadow-md">
            @error('email')
                <span class="text-red-500 text-sm">{{$message}}</span>
            @enderror

        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input type="password" id="password" name="password" value="{{old('password')}}" class="mt-1 p-3 w-full border border-gray-300 outline-none rounded-md shadow-md">
            <!-- <img src="/images/eye.png" alt="" height="40" width="40" onclick="changer()"> -->
             <wa-icon name="eye"></wa-icon>
            @error('password')
                <span class="text-red-500 text-sm">{{$message}}</span>
            @enderror

        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 p-3 w-full border border-gray-300 outline-none rounded-md shadow-md">
            <!-- @error('password')
                <span class="text-red-500 text-sm">{{$message}}</span>
            @enderror -->

        </div>
        <button type="submit" class="py-2 px-4 bg-purple-700 hover:bg-purple-500 text-white rounded-md w-full">s'inscrire</button>

        <p>
            Déja un compte ?
            <a href="{{route('login')}}" class="text-red-500">se connecter</a>
        </p>


    </form>
    <!-- <script>
    document.addEventListener("DOMContentLoaded",function(){

    const inputBox=document.querySelector('footer div')
    document.addEventListener('keydown',function(event){
        typed+= event.key;
        if(typed.lengh>42){
            typed = typed.slice(-42);
        }
        A.textContent= typed;
    

    })


    })

</script> -->

</div>

@endsection



