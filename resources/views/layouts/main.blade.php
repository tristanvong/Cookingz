<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Cookingz</title>
    <link rel="icon" href=" {{ asset('images/cookingz-favicon.svg') }} ">
    @vite('resources/css/app.css')
    <style>
        /* "All content (UI elements) on this site are published under the MIT License." */
        /* Credits: (free to use MIT license) From Uiverse.io by kennyotsu */ 
        .background-pattern {
        width: 100%;
        height: 100%;
        background-color: #313131;
        background-image: radial-gradient(rgba(255, 255, 255, 0.171) 2px, transparent 0);
        background-size: 30px 30px;
        background-position: -5px -5px
        }
    </style>
</head>
<body class="background-pattern font-sans flex flex-col min-h-screen">
    <header class="background-pattern">
        @include('components.navigation-bar')
    </header>
    
    <main class="flex-grow">
        @yield('content')
    </main>

    <footer>
        @include('components.footer')
    </footer>
</body>
</html>