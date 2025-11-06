@extends('app')

@section('content')

<div class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500 min-h-screen">
        <div class="absolute bg-y-50 w-full top-0 bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg')] min-h-75">
            <span class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
        </div>

        @include('components.nav')

        <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
            @include('components.sidebar')

            <div class="max-w-4xl mx-auto mt-[10%] p-6 bg-white rounded-lg shadow-lg">
                <h2 class="text-2xl md:text-3xl font-bold mb-6 text-blue-500 text-center md:text-left">My Profile</h2>

                <!-- Messages flash -->
                @if(session('success'))
                    <div class="p-3 mb-4 text-green-700 bg-green-100 rounded text-sm md:text-base">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="p-3 mb-4 text-red-700 bg-red-100 rounded text-sm md:text-base">{{ session('error') }}</div>
                @endif

                <!-- Grille responsive -->
                <div class="">
                    <!-- Formulaire de mise à jour -->
                    <form action="{{ route('user.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name" class="block mb-1 font-medium">Name</label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $user->name) }}"
                                class="w-full p-3 border rounded shadow-md focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="block mb-1 font-medium">Email</label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $user->email) }}"
                                class="w-full p-3 border rounded shadow-md focus:ring-2 focus:ring-blue-400 focus:outline-none cursor-pointer" disabled>
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="phone" class="block mb-1 font-medium">Phone</label>
                            <input type="text" name="phone" id="phone"
                                value="{{ old('phone', $user->phone) }}"
                                class="w-full p-3 shadow-md border rounded focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit"
                                class=" md:w-auto px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                            Update Account
                        </button>
                    </form>

                    <!-- Formulaire de suppression -->
                    <div class="flex justify-end">
                        <a href="{{ route('password.change') }}" class="m-3 text-sm text-blue-500">Change Password</a>
                        <form action="{{ route('user.delete') }}" method="POST"
                            onsubmit="return confirm('Are you sure to want delete your account ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="md:w-auto px-4 py-2 bg-white text-red-500 border-2 shadow-sm rounded hover:bg-red-600 transition">
                                Delete Account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>


@endsection
