@extends('app')

@section('content')

    <div class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500 min-h-screen">
        <div class="absolute bg-y-50 w-full top-0 bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg')] min-h-75">
            <span class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
        </div>

        @include('components.nav')

        <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
            @include('components.sidebar')

            <div class="mt-20 mx-2 xl:mx-10">

            @if (session('success'))
                <!-- <script>
                    alert("{{ session('success') }}");
                </script>
            @endif

            @if (session('error'))
                <script>
                    alert("{{ session('error') }}");
                </script>
            @endif -->

            @if (session('success'))
                <div class="flex items-center p-4 mb-4 text-sm text-green-700 bg-green-100 border border-green-300 rounded-lg relative" role="alert">
                    <svg class="flex-shrink-0 w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11V5a1 1 0 10-2 0v2a1 1 0 002 0zm0 8v-4a1 1 0 10-2 0v4a1 1 0 002 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-green-700 hover:text-green-900">
                        &times;
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="flex items-center p-4 mb-4 text-sm text-red-700 bg-red-100 border border-red-300 rounded-lg relative" role="alert">
                    <svg class="flex-shrink-0 w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11V5a1 1 0 10-2 0v2a1 1 0 002 0zm0 8v-4a1 1 0 10-2 0v4a1 1 0 002 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-red-700 hover:text-red-900">
                        &times;
                    </button>
                </div>
            @endif


                <div class="relative mb-5 flex flex-col flex-auto min-w-0 px-2 lg:p-2 mx-6 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
                    <div class="flex flex-wrap -mx-3">
                        <div class="flex-none w-auto max-w-full px-3">
                            <div class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl">
                                <img src="{{ asset('../assets/images/liste.jpg') }}" alt="profile_image" class="w-full shadow-2xl rounded-xl" />
                            </div>
                        </div>
                        <div class="flex-none w-auto max-w-full px-3 my-auto">
                            <div class="h-full">
                                <h5 class="mb-1 dark:text-white">Your Articles</h5>
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 mx-auto lg:mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                            <div class="relative right-0">
                                <ul class="relative flex flex-wrap mb-2 p-1 list-none bg-blue-300 rounded-xl" nav-pills role="tablist">
                                    <li class="z-30 flex-auto text-center">
                                        <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700" nav-link active href="{{ route('ads.createAd') }}" role="tab" aria-selected="true">
                                            <i class="ni ni-fat-add"></i>
                                            <span class="ml-2">Add Article</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-none w-full max-w-full px-3">
                    <div class="relative p-10 flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">

                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <table id="myTable"
                                    class="w-full text-sm text-left text-gray-700 border-collapse rounded-lg overflow-hidden shadow-md">
                                    <thead class="bg-blue-100 text-blue-700 uppercase text-xs">
                                        <tr>
                                            <th class="px-6 py-3">Articles</th>
                                            <th class="px-6 py-3">Location</th>
                                            <th class="px-6 py-3 text-center">Price</th>
                                            <th class="px-6 py-3 text-center">Creation date</th>
                                            <th class="px-6 py-3 text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">


                                        @foreach($userAds as $ad)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <!-- Article -->
                                                <td class="px-6 py-4 flex items-center">
                                                    <img src="{{ asset('storage/' .$ad->image) }}"
                                                        alt="{{ $ad->title }}"
                                                        class="h-10 w-10 rounded-lg mr-3 object-cover">
                                                    <div class="pt-5">
                                                        <h6 class="text-gray-800 font-medium">{{ $ad->title }}</h6>
                                                        <p class="text-xs text-gray-500">{{ $ad->category->name }}</p>
                                                    </div>
                                                </td>

                                                <!-- Location -->
                                                <td class="px-6 py-4">
                                                    <span class="text-sm font-semibold text-gray-700">{{ $ad->location }}</span>
                                                </td>

                                                <!-- Price -->
                                                <td class="px-6 py-4 text-center">
                                                    <span class="text-sm text-gray-600">{{ number_format($ad->price, 0, ',', ' ') }} FCFA</span>
                                                </td>

                                                <!-- Date -->
                                                <td class="px-6 py-4 text-center">
                                                    <span class="text-xs text-gray-500">
                                                        {{ $ad->created_at->format('d M Y') }}
                                                    </span>
                                                </td>

                                                <!-- Actions -->
                                                <td class="px-6 py-4 flex justify-center space-x-3">
                                                    <!-- Edit -->
                                                    <a href="{{ route('ads.editAd', $ad) }}"
                                                    class="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 -960 960 960" width="22px" fill="#F19E39">
                                                            <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/>
                                                        </svg>
                                                    </a>

                                                    <!-- Delete -->
                                                    <form action="{{ route('ads.destroy', $ad) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this ad?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#BB271A">
                                                                <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>



        @push('scripts')
            <script>
                $(document).ready(function () {
                    $('#myTable').DataTable({
                        paging: true,          // Pagination
                        searching: true,       // Barre de recherche
                        ordering: true,        // Tri des colonnes
                        info: true,            // Infos en bas ("Showing 1 of ...")
                        responsive: true,      // Mode responsive
                        lengthMenu: [5, 10, 25, 50, 100], // Choix du nombre d'entrées
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json"
                        },
                        dom: '<"flex justify-between items-center mb-4"lf>rt<"flex justify-between items-center mt-4"ip>'
                    });
                });
            </script>
        @endpush



    </div>



@endsection
