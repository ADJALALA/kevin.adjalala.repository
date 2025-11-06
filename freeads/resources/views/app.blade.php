<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Post ads for free.">
        <title>@yield('title', 'Mon app')</title>

        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('./assets/img/logo.png') }}" />
        <link rel="icon" type="image/png" href="{{ asset('./assets/img/logo.png') }}" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

        <!-- Nucleo Icons -->
        <link href="{{ asset('./assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('./assets/css/nucleo-svg.css') }}" rel="stylesheet" />
        <!-- Main Styling -->
        <link href="{{ ('./assets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

        <!-- DataTables CSS (avec Tailwind) -->
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css" rel="stylesheet" />

        <!-- DataTables Buttons CSS -->
        <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet" />

        <!-- Responsive -->
        <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet" />

    </head>

    <body>
        <div class="min-h-screen">
            @yield('content')
        </div>

        <!-- Popper -->
        <script src="https://unpkg.com/@popperjs/core@2"></script>

        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

        @stack('scripts')
    </body>
</html>
