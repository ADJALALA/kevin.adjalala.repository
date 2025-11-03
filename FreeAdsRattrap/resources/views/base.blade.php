<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/resources/css//app.css">
    <title>@yield('title')</title>
  </head>
  <style>
    body{
      background-image: url(/images/bg.jpeg);
    }

  </style>
  <body>
    <nav class="bg bg-gray-950 text-white p-4 flex justify-between space-x-4">
        <ul>
            <li>
                <a href="/">Home</a>
            </li>
        </ul>
        <a href="{{route('login')}}"></a>

    </nav>


    <div>
        @yield('content')
    </div>
    @yield('scripts')
  </body>
</html>