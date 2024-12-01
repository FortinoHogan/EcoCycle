<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EcoCycle</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset('asset/Logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js" defer></script>

</head>

<body>
    <div>
        @include('component.navbar')
    </div>

    <div class="max-sm:mt-20">
        @yield('konten')
    </div>

    <div>
        @include('component.footer')
    </div>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    @yield('scripts')
</body>

</html>
