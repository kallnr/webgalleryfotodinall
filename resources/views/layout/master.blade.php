<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/output.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hurricane&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    < <style>
        @media(max-width:768px) {
        .flex-container {
        flex-direction: column;
        }

        .fulwidth {
        width: 100%;
        }

        .fulheight {
        height: 100%;
        }
        }
        </style>
        @stack('cssjsexternal')
        <title>Gallifyyyyyyyyyyyyy</title>
</head>

<body class="bg-slate-300">


    <nav class="fixed top-0 z-20 w-full bg-white shadow-md">
        <div class="flex flex-wrap items-center justify-center max-w-screen-xl p-4 mx-auto">
            <div class="flex items-center">

                <a href="/explore" class=" ps-3 mr-4 transition duration-500 ease-in-out hover:scale-105">EXPLORE</a>
                {{-- <a href="/album" class="mr-4 transition duration-500 ease-in-out hover:scale-105">+ Album</a> --}}
                <form action="/explore" method="get"> <input type="search"
                    class="h-8 px-4 border-2 text-gray-700 rounded-full w-52 transition duration-500 ease-in-out hover:scale-105"
                    placeholder="Search ..." name="cari">
                </form>
                <a href="/upload" class="mr-4 ps-3 transition duration-500 ease-in-out hover:scale-105">Post</a>
                <div class="flex items-center space-x-1 md:order-2 md:space-x-0 rtl:space-x-reverse">
                    <img src="/pic/{{ old('foto_profil', Auth::User()->foto_profil) }}" alt=""
                        class="w-10 h-10 border-2 rounded-full transition duration-500 ease-in-out hover:scale-105"
                        data-dropdown-toggle="user-dropdown-menu">
                    <!-- Drop Down -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow "
                        id="user-dropdown-menu">
                        <ul class="py-2" role="none">
                            <li>
                                <a href="/profil" class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">
                                    <div class="inline-flex items-center">
                                        Profile
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="/logout" class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">
                                    <div class="inline-flex items-center">
                                        Log Out
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Navigation -->
                </div>
            </div>
    </nav>
    @yield('content')
    @stack('footerjsexternal')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>
