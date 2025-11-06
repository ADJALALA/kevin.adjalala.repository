@extends('app')

@section('content')
<div class="min-h-screen flex flex-col bg-gray-50">

    <!-- NAVBAR -->
    <header class="flex items-center justify-between px-6 py-4 border-b bg-white shadow-sm">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('assets/img/logo.png') }}"
                 class="inline h-10 transition-all duration-200 ease-in-out"
                 alt="main_logo" />
            <span class="font-bold text-xl text-blue-600">HOME</span>
        </div>
        <!-- Boutons -->
        <div class="flex items-center space-x-4">
            <a href="{{ auth()->check() ? route('ads.createAd') : route('login') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                + Post Ad
            </a>
            <a href="{{ route('login') }}" class="text-gray-700 font-medium hover:text-blue-600">Login</a>
        </div>
    </header>

    <!-- HERO / SEARCH -->
    <section class="relative bg-[url('{{ asset('assets/images/bg.jpeg') }}')] bg-auto bg-no-repeat bg-cover">
        <div class="relative z-10 max-w-4xl mx-auto text-center py-20 px-6">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Find What You Need On FreeAds</h1>
            <p class="text-lg text-gray-200 mb-8">Browse through thousands of ads near you</p>
            <form method="GET" action="#" class="flex items-center max-w-2xl mx-auto bg-white rounded-xl overflow-hidden shadow-md">
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="Search for ads..."
                    class="flex-1 px-4 py-3 focus:outline-none text-gray-700">
                <button type="submit" class="bg-blue-600 px-6 py-3 text-white font-medium hover:bg-blue-700">
                    Search
                </button>

        </div>
    </section>

    <!-- MAIN CONTENT -->
    <main class="flex flex-col lg:flex-row max-w-7xl mx-auto w-full px-6 py-10 space-y-6 lg:space-y-0 lg:space-x-6">

        <!-- SIDEBAR -->
        <aside class="lg:w-1/4 bg-white rounded-2xl shadow-md p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Filters</h3>

            <!-- Category -->
            <div class="mb-5">
                <label class="block text-gray-600 font-medium mb-1">Category</label>
                <select name="category_id" class="w-full border border-blue-500 rounded-lg px-3 py-2 text-gray-700">
                    <option value="">All</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Location -->
            <div class="mb-5">
                <label class="block text-gray-600 font-medium mb-1">Location</label>
                <input type="text" name="location" value="{{ request('location') }}"
                    class="w-full border border-blue-500 rounded-lg px-3 py-2 text-gray-700" placeholder="Ex: Bohicon">
            </div>

            <!-- Price -->
            <div class="mb-5">
                <label class="block text-gray-600 font-medium mb-1">Price Range</label>
                <div class="flex space-x-2">
                    <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min"
                        class="w-1/2 border border-blue-500 rounded-lg px-3 py-2 mr-1 text-gray-700">

                    <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max"
                        class="w-1/2 border border-blue-500 rounded-lg px-3 py-2 text-gray-700">
                </div>
            </div>

            <!-- Date -->
            <div class="mb-5">
                <label class="block text-gray-600 font-medium mb-1">Posted</label>
                <select name="date" class="w-full border border-blue-500 rounded-lg px-3 py-2 text-gray-700">
                    <option value="">Anytime</option>
                    <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>Today</option>
                    <option value="week" {{ request('date') == 'week' ? 'selected' : '' }}>This Week</option>
                    <option value="month" {{ request('date') == 'month' ? 'selected' : '' }}>This Month</option>
                </select>
            </div>

            <!-- Condition -->
            <div class="mb-5">
                <label class="block text-gray-600 font-medium mb-1">Condition</label>
                <div class="flex">
                    <label class="flex items-center space-x-2 w-1/2 mt-2 border rounded-lg border-blue-500 py-1 px-2 ml-2">
                        <input type="checkbox" name="condition[]" value="new" class="mx-2 rounded text-blue-500">
                        <span>New</span>
                    </label>
                    <label class="flex items-center space-x-2 w-1/2 mt-2 border rounded-lg border-blue-500 py-1 px-2 ml-2">
                        <input type="checkbox" name="condition[]" value="good" class="mx-2 rounded text-blue-500">
                        <span>Good</span>
                    </label>
                    <label class="flex items-center space-x-2 w-1/2 mt-2 border rounded-lg border-blue-500 py-1 px-2 ml-2">
                        <input type="checkbox" name="condition[]" value="used" class="mx-2 rounded text-blue-500">
                        <span>Used</span>
                    </label>
                </div>
            </div>

            <!-- Apply button -->
            <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-xl hover:bg-blue-600 transition">
                Apply Filters
            </button>
        </aside>

    </form>
        <!-- ADS LIST -->
        <section class="flex-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($ads as $ad)
                <a href="{{ route('adsdetail', $ad->id) }}" class="group">
                    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition">
                        <div class="relative h-48 bg-gray-100">
                            <img src="{{ asset('storage/'.$ad->image) }}" alt="{{ $ad->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <span class="absolute bottom-3 right-3 bg-blue-600 text-white text-sm px-3 py-1 rounded-full shadow">
                                {{ $ad->price }} FCFA
                            </span>
                        </div>
                        <div class="p-4">
                            <h4 class="font-semibold text-lg text-gray-800 truncate">{{ $ad->title }}</h4>
                            <p class="text-gray-500 text-sm mt-1">{{ Str::limit($ad->description, 80) }}</p>
                            <div class="flex justify-between items-center mt-3 text-sm text-gray-600">
                                <span>By <strong class="text-blue-600">{{ $ad->user->name ?? 'Anonyme' }}</strong></span>
                                <span>{{ $ad->location }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full bg-white p-6 rounded-xl shadow text-center text-gray-600">
                    No ads found.
                </div>
            @endforelse

            <!-- Pagination -->
            <div class="col-span-full mt-6">
                {{ $ads->links() }}
            </div>
        </section>
    </main>

    <!-- CONTACT SECTION -->
    <section class="bg-blue-50 py-16 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-blue-500 mb-6">Contact Us</h2>
            <p class="text-gray-700 mb-8">Have questions or suggestions? Send us a message!</p>
            <form action="" method="POST" class="bg-blue-950 rounded-2xl shadow-md p-10 flex flex-col space-y-5">
                @csrf
                <input type="text" name="name" placeholder="Your Name" required
                    class="border rounded-lg px-3 py-4 mb-5 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="email" name="email" placeholder="Your Email" required
                    class="border rounded-lg px-3 py-4 mt-5 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <textarea name="message" placeholder="Your Message" rows="5" required
                    class="border rounded-lg px-3 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                <button type="submit" class="bg-white shadow-2xl py-2 rounded-lg hover:bg-blue-700 transition">
                    Send Message
                </button>
            </form>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-gray-200 py-8 mt-10">
        <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <p>&copy; {{ date('Y') }} DabaliDuCode. All rights reserved.</p>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-white transition">About</a>
                <a href="#" class="hover:text-white transition">Privacy</a>
                <a href="#" class="hover:text-white transition">Contact</a>
            </div>
        </div>
    </footer>
</div>
@endsection
