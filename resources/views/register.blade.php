<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/output.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hurricane&display=swap" rel="stylesheet">
</head>

<body>

<body class="bg-slate-300">
    <nav class="fixed top-0 z-20 w-full text-black bg-white shadow-md">
        <div class="flex items-center justify-between max-w-screen-md mx-auto">

            <div class="flex items-center">
                <img src="/assest/logo.png" alt="">
            <h2 class="text-3xl font-telex ps-3">Gallify</h2>
        </div>
        <div>
            <button  class="px-4 text-white bg-blue-700 rounded-full font-telex transition duration-500 ease-in-out hover:scale-105"><a href="login">Login</a></button>

        </div>
        
        </div>
    </nav>
    <div class="my-[150px]">
        <form action="/registered" method="POST">
            @csrf
            <section class="mt-70">
                <div class="max-w-[364px] bg-gray-100 shadow-2xl mx-auto px-6 py-4 rounded-3xl">
                    <div class="flex flex-col">
                        <br>
                        <h3 class="mx-auto text-3xl font-telex">Gallify</h3>
                        @if ($message = Session::get('success'))
                    
                <div id="alert-1" class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="text-sm font-medium ms-3">
                      {{ $message }}
                    </div>
                      <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-1" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                  </div>
                @endif
    
                    <h5 class="mt-5 mx-7">Username</h5>
                    <input type="text" name="username" class="py-1 px-2 rounded-full text-slate-700 mx-5 border border-gray-700  transition duration-500 ease-in-out hover:scale-105">
                    <h5 class="mt-5 mx-7">Email</h5>
                    <input type="email" name="email" class="py-1 px-2 rounded-full text-slate-700 mx-5 border border-gray-700  transition duration-500 ease-in-out hover:scale-105">
                    <h5 class="mt-5 mx-7">Password</h5>
                    <input type="password" name="password" class="py-1 px-2 rounded-full text-slate-700 mx-5 border border-gray-700  transition duration-500 ease-in-out hover:scale-105">
                    <button type="submit" class="py-1 mt-4 mx-5 text-center text-white rounded-full bg-blue-700 font-telex transition duration-500 ease-in-out hover:scale-105">Register</button>
                <hr class="mt-4 mx-3">
                    <small class="mt-3 mx-5 mb-4 text-center  transition duration-500 ease-in-out hover:scale-105">Already have account?<span class="text-blue-700 underline"><a href="login">Login!</a></span></small>
                    </div>
                </div>
            </section>
        </form>
       </div>
    <script src="/node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>