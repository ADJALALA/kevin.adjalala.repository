<!-- <nav class="bg-white border-b border-gray-200 shadow-md" x-data="{ open: false }">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center"> -->

      <!-- Logo -->
      <!-- <div class="flex-shrink-0 flex items-center">
        <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">FreeAds</a>
      </div> -->

      <!-- Desktop Menu -->
      <!-- <div class="hidden md:flex space-x-6 items-center">

        <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">Home</a>

        @guest
          <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">Register</a>
          <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
        @endguest

        @auth
          <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-gray-700 hover:text-red-600">Logout</button>
          </form>
        @endauth -->

        <!-- Dropdown -->
        <!-- <div class="relative group">
          <button class="text-gray-700 hover:text-blue-600 inline-flex items-center">
            Dropdown
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 9l-7 7-7-7" />
            </svg>
          </button> -->
          <!-- <div class="absolute hidden group-hover:block bg-white border rounded-lg shadow-md mt-2 w-40">
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Action</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Another Action</a>
            <div class="border-t"></div>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Something Else</a>
          </div>
        </div>

      </div> -->

      <!-- Mobile Hamburger -->
      <!-- <div class="md:hidden flex items-center">
        <button @click="open = !open" class="text-gray-700 focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div> -->

    </div>

    <!-- Mobile Menu -->
    <!-- <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden mt-2 space-y-1">
      <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Home</a>
      
      @guest
        <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Register</a>
        <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Login</a>
      @endguest

      @auth
        <form action="{{ route('logout') }}" method="POST" class="px-4 py-2">
          @csrf
          <button type="submit" class="text-gray-700 hover:text-red-600">Logout</button>
        </form>
      @endauth
    </div> -->

    <!-- Links
<div class="hidden md:flex space-x-6 items-center">
    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">Home</a>
    <a href="{{ route('user.show') }}" class="text-gray-700 hover:text-blue-600">Ads</a>
    @guest
        <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">Register</a>
        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
    @endguest
    @auth
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-gray-700 hover:text-red-600">Logout</button>
        </form>
    @endauth 
</div>

  </div>
</nav>
