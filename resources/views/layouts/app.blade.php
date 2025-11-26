<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script type="text/javascript" src="https://public.tableau.com/javascripts/api/tableau-2.min.js"></script>
        <style>
            #tableauViz {
                width: 100%;
                height: 50vh;
                
                margin-top : 100px; /* Mengisi seluruh tinggi viewport */
            }
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <aside class="w-64 bg-white shadow-md px-4 py-6 hidden md:block">
                    <h2 class="text-2xl font-bold text-blue-600 mb-6">My App</h2>

                    <nav class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">Dashboard</a>
                        <a href="{{ route('users.index') }}" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">Users</a>
                        <a href="{{ route('files') }}" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">OneDrive Files</a>
                        <a href="{{ route('settings') }}" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">Settings</a>
                    </nav>
                </aside>
                {{ $slot }}
                  @yield('content')
            </main>
        </div>
        @stack('script')
    </body>
</html>
