@extends('app')

@section('content')

    <div class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500 ">
        <div class="absolute bg-y-50 w-full top-0 bg-[url('{{ asset('../assets/images/edit.jpg') }}')] bg-center bg-no-repeat bg-cover min-h-75">
            <span class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
        </div>

        @include('components.nav')

        <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
            @include('components.sidebar')

            <div class="flex m-2 items-center justify-start gap-4 px-3 py-2">
                <!-- Bouton Back -->
                <div>
                    <a href="{{ route('ads.listeAds') }}"
                        class="flex items-center gap-2 px-3 py-1 text-slate-700 rounded-lg bg-blue-50 hover:bg-blue-100 transition">
                        <i class="ni ni-bold-left"></i>
                        <span>Back</span>
                    </a>
                </div>
            </div>

            <div class="container mx-auto flex flex-1 justify-center items-center">
                <div class="w-full max-w-4xl">
                    <div class="leading-loose">
                        <form class=" m-4 p-10 bg-white rounded shadow-xl" action="{{ route('ads.update', $ad) }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            @method('PUT')

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
                                <input class="w-full p-5 text-gray-700 shadow-md shadow-blue-100 rounded" id="username" name="title" type="text" required value="{{ old('title', $ad->title ) }}" aria-label="username">
                                @error('title')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label class="block text-sm pt-2 text-gray-700" for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="w-full p-5 text-gray-700 shadow-md shadow-blue-100 rounded">
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}"
                                            {{ old('category_id', $ad->category_id) == $categorie->id ? 'selected' : '' }}>
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
                                <textarea name="description" id="description" class="w-full p-5 text-gray-700 shadow-md shadow-blue-100 rounded">{{ old('description', $ad->description ) }}</textarea>
                                @error('description')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="image-container mt-2">
                                <label for="image">Current Image</label>
                                @if($ad->image)
                                    <img src="{{ asset('storage/' .$ad->image) }}" alt="image" width="50">
                                    <input type="hidden" name="old_image" value="{{ $ad->image }}">
                                @else
                                    <div class="text-red-500 text-sm">No Image</div>
                                @endif
                            </div>

                            <div id="image-container mt-2">
                                <label class="block pt-2 text-sm text-gray-00" for="image">Change Image</label>
                                <input class="w-full p-5 text-gray-700 shadow-md shadow-blue-100 rounded" id="username" type="file" name="image" accept="image/*" aria-label="Image">
                                @error('image')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label class="block pt-2 text-sm text-gray-00" for="username">Price</label>
                                <input class="w-full p-5 text-gray-700 shadow-md shadow-blue-100 rounded" id="username" name="price" type="number" required value="{{ old('price', $ad->price ) }}">
                                @error('price')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label class="block text-sm pt-2 text-gray-00" for="username">Location</label>
                                <input class="w-full p-5 text-gray-700 shadow-md shadow-blue-100 rounded" id="username" name="location" type="text" required value="{{ old('location', $ad->location ) }}" aria-label="username">
                                @error('location')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <input type="submit" class="py-2 px-3 bg-yellow-500 text-white rounded" value="Edit Article">
                            </div>
                        </form>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>

    </div>




@endsection
