@extends('app')

@section('content')

    <div class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500 min-h-screen">
        <div class="absolute bg-y-50 w-full top-0 bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg')] min-h-75">
            <span class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
        </div>

        @include('components.nav')

        <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
            @include('components.sidebar')

            <div class="relative mt-2 flex flex-col flex-auto min-w-0 px-2 lg:p-2 mx-6 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-none w-auto max-w-full px-3">
                    <div class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl">
                        <img src="{{ asset('../assets/images/create.jpg') }}" alt="profile_image" class="w-full shadow-2xl rounded-xl" />
                    </div>
                    </div>
                    <div class="flex-none w-auto max-w-full px-3 my-auto">
                    <div class="h-full">
                        <h5 class="mb-1 dark:text-white">New Article</h5>
                    </div>
                    </div>
                    <div class="w-full max-w-full px-3 mx-auto lg:mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                    <div class="relative right-0">
                        <ul class="relative flex flex-wrap mb-2 p-1 list-none bg-blue-50 rounded-xl" nav-pills role="tablist">
                            <li class="z-30 flex-auto text-center">
                                <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700" nav-link active href="{{ route('ads.listeAds') }}" role="tab" aria-selected="true">
                                    <i class="ni ni-app"></i>
                                    <span class="ml-2">Liste</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>

            <div class="container mx-auto h-full flex flex-1 justify-center items-center">
                <div class="w-full max-w-4xl">
                    <div class="leading-loose">
                        <form class=" m-4 p-10 bg-white rounded shadow-xl" action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">

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

                            <div class="mb-2">
                                <label class="block text-sm text-gray-00" for="username">Title</label>
                                <input class="w-full p-2 text-gray-700 shadow-md shadow-blue-100 rounded" id="username" name="title" type="text" required value="{{ old('title') }}" aria-label="username">
                                @error('title')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label class="block text-sm pt-2 text-gray-700" for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="w-full p-2 text-gray-700 shadow-md shadow-blue-100 rounded">
                                    <option value="">Choose Category</option>
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}"
                                            {{ old('category_id', $ad->category_id ?? '') == $categorie->id ? 'selected' : '' }}>
                                            {{ $categorie->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label class="block text-sm pt-2 text-gray-00" for="description">Description</label>
                                <textarea name="description" id="description" class="w-full p-2 text-gray-700 shadow-md shadow-blue-100 rounded">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="image-container mt-2">
                                <label class="block pt-2 text-sm text-gray-00" for="image">Image</label>
                                <input class="w-full p-2 text-gray-700 shadow-md shadow-blue-100 rounded" id="username" type="file" name="image" accept="image/*" aria-label="Image">
                                @error('image')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label class="block pt-2 text-sm text-gray-00" for="username">Price</label>
                                <input class="w-full p-2 text-gray-700 shadow-md shadow-blue-100 rounded" id="username" name="price" type="number" required value="{{ old('price') }}" aria-label="username">
                                @error('price')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label class="block text-sm pt-2 text-gray-00" for="username">Location</label>
                                <input class="w-full p-2 text-gray-700 shadow-md shadow-blue-100 rounded" id="username" name="location" type="text" required value="{{ old('location') }}" aria-label="username">
                                @error('location')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <input type="submit" class="py-2 px-3 bg-blue-500 text-white rounded" value="Create Article">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

@endsection
