<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? '' }} | Mooi.lloons</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    @yield('head')

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: "poppins, sans-serif",
                        comfortaa: "Comfortaa, sans-serif",
                    },
                },
            },
        }
    </script>
</head>

<body class="bg-sky-50 font-poppins">
    @include('layout.partial.navbar')

    @yield('container')

    @include('layout.partial.footer')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="/js/script.js"></script>
    @yield('script')
</body>

</html>
