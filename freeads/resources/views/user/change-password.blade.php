@extends('app')

@section('content')

<div class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500 min-h-screen">
        <div class="absolute bg-y-50 w-full top-0 bg-[url('{{ asset('../assets/images/changePas.jpg') }}')] bg-center bg-no-repeat bg-cover min-h-75">
            <span class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
        </div>

        @include('components.nav')

        <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
            @include('components.sidebar')

            <div class="flex m-2 items-center justify-start gap-4 px-3 py-2">
                <!-- Bouton Back -->
                <div>
                    <a href="{{ route('user.profile') }}"
                        class="flex items-center gap-2 px-3 py-1 text-slate-700 rounded-lg bg-blue-50 hover:bg-blue-100 transition">
                        <i class="ni ni-bold-left"></i>
                        <span>Back</span>
                    </a>
                </div>
            </div>

            <div class="max-w-lg mx-auto mt-[5%] p-10 bg-white shadow rounded">
                <h2 class="text-xl font-semibold mb-4">Change Password</h2>

                @if(session('success'))
                    <div class="p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
                @endif

                <form action="{{ route('password.change.post') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label>Current password</label>
                        <input type="password" name="current_password" class="w-full border rounded p-2">
                        @error('current_password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>New password</label>
                        <input type="password" name="password" class="w-full border rounded p-2">
                        @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>Confirm password</label>
                        <input type="password" name="password_confirmation" class="w-full border rounded p-2">
                    </div>

                    <button type="submit" class="w-full mt-2 bg-blue-500 text-white py-2 rounded">Update</button>
                </form>
            </div>
        </main>


@endsection
