<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('asset/Logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>EcoCycle</title>
</head>
<body>
    @yield('konten')

    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast-success');
            if (toast) {
                toast.remove();
            }
        }, 3000);
    </script>

    <style>
        @keyframes progress {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        .animate-progress {
            animation: progress 3s linear forwards;
            /* Matches the auto-hide duration */
        }
    </style>
</body>
</html>
