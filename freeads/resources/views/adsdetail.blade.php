@extends('app')

@section('content')

    <div>
        <header class="flex items-center justify-between px-6 py-4 shadow-lg bg-white">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('assets/img/logo.png') }}"
                    onerror="this.onerror=null; this.replaceWith(document.createTextNode(this.alt));"
                    class="h-10"
                    alt="main_logo" />
                <span class="font-bold text-lg">HOME</span>
            </div>
            <!-- Boutons -->
            <div class="flex items-center space-x-4">
                <a href="{{ auth()->check() ? route('ads.createAd') : route('login') }}"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-600 transition">
                    + Post Ads
                </a>
                <a href="{{ route('login') }}" class="text-gray-700 font-medium">Login</a>
            </div>
        </header>

        <div class="bg-[url('{{ asset('assets/images/bg1.jpg') }}')] bg-center bg-no-repeat bg-cover min-h-screen p-4 sm:p-10 lg:p-20">
            <div class="max-w-4xl mx-auto bg-white rounded-3xl p-6 shadow-lg shadow-orange-100">

                <!-- Image principale + Description -->
                <div class="flex flex-col text-center md:text-left md:flex-row md:space-x-10 space-y-6 md:space-y-0">

                    <!-- Image -->
                    <img src="{{ asset('storage/' . $ad->image) }}"
                        alt="{{ $ad->title }}"
                        class="w-full md:w-1/3 h-1/2 object-cover rounded-lg shadow-md">

                    <!-- Description -->
                    <div class="p-2 w-full">
                        <h6 class="text-lg font-semibold mb-2">Description</h6>
                        <p class="prose max-w-none text-gray-700 mb-6">
                            {{ $ad->description }}
                        </p>
                    </div>
                </div>

                <!-- Titre + Prix -->
                <div class="flex flex-col md:flex-row md:space-x-50 md:items-center text-center md:text-left md:mt-6">
                    <div>
                        <h2 class="text-2xl pb-2 text-orange-600 font-semibold">{{ $ad->title }}</h2>
                        <p class="text-gray-600 mb-2">
                            Category : <span class="font-medium text-blue-600">{{ $ad->category->name ?? 'N/A' }}</span>
                        </p>
                        <p class="text-gray-600 mb-2">
                            Posted by : <span class="font-medium">{{ $ad->user->name ?? 'Anonyme' }}</span>
                        </p>
                        <p class="text-gray-600 mb-4">
                            Located at : <span class="font-medium">{{ $ad->location }}</span>
                        </p>
                    </div>

                    <span class="bg-orange-500 text-white px-4 py-2 rounded-full text-lg font-semibold mt-4 md:mt-0">
                        {{ $ad->price }} FCFA
                    </span>
                </div>

                <!-- Back -->
                <div class="mt-6">
                    <a href="{{ route('index') }}"
                    class="inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                        ← Back to list
                    </a>
                </div>
            </div>
        </div>

    </div>


@endsection
