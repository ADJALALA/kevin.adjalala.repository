@extends('app')

@section('title', 'Dashboard')

@section('content')
    <div class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500 min-h-screen">
        <div class="absolute bg-y-50 w-full top-0 bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg')] min-h-75">
            <span class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
        </div>
    @include('components.nav')
    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        @include('components.sidebar')

        <div class="w-full px-6 py-6 mx-auto">

            <!-- KPIs -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
                <div class="p-6 bg-white rounded-xl shadow">
                    <p class="text-sm text-gray-500">Articles</p>
                    <h2 class="mb-2 font-bold dark:text-white">{{ \App\Models\Ads::count() }}</h2>
                    <span class="text-green-500 text-sm"><a href="{{ route('ads.createAd') }}">Publish</a></span>
                </div>
                <div class="p-6 bg-white rounded-xl shadow">
                    <p class="text-sm text-gray-500">Orders</p>
                    <h2 class="text-2xl font-bold">20</h2>
                    <span class="text-red-500 text-sm">-2% this month</span>
                </div>
                <div class="p-6 bg-white rounded-xl shadow">
                    <p class="text-sm text-gray-500">Income</p>
                    <h2 class="text-2xl font-bold">15,200 €</h2>
                    <span class="text-green-500 text-sm">+12% since yesterday</span>
                </div>
                <div class="p-6 bg-white rounded-xl shadow">
                    <p class="text-sm text-gray-500">Product</p>
                    <h2 class="text-2xl font-bold">78</h2>
                    <span class="text-gray-400 text-sm">stable</span>
                </div>
            </div>

            <!-- Graphiques -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-lg font-semibold mb-4">Sales development</h3>
                    <canvas id="salesChart" height="200"></canvas>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-lg font-semibold mb-4">Evolution of publications</h3>
                    <canvas id="adsChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Charts.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const salesCtx = document.getElementById('salesChart').getContext('2d');
new Chart(salesCtx, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May'],
        datasets: [{ label: 'Ventes', data: [120, 150, 180, 90, 200], borderColor: '#3b82f6', fill: false }]
    }
});



const adsCtx = document.getElementById('adsChart').getContext('2d');
    new Chart(adsCtx, {
        type: 'line',
        data: {
            labels: @json($months), // ['Jan', 'Fév', ...]
            datasets: [{
                label: 'Publications',
                data: @json($totals), // [5, 10, 3, 0, ...]
                borderColor: '#3b82f6',
                fill: false
            }]
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection
