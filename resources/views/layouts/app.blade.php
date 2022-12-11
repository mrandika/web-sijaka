<html>
    <head>
        @livewireStyles
    </head>

    <body>
    {{ $slot }}

    @vite(['resources/js/app.js'])
    @livewireScripts
    </body>
</html>
