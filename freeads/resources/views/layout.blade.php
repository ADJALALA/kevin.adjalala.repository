<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Custom Auth Laravel')</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100 bg-[url(/public/blog_image.jpg)]">

    <!-- @include('include.header') -->
    <div class="min-h-screen flex items-center justify-center">
      @yield('content')
    </div>
  </body>
</html>
