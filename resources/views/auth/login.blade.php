<!-- component -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Mr Kuku Invoice Management System Log in">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

        <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Invoice Management System</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>

<body>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <div class="flex flex-col max-w-md px-4 py-8 bg-white shadow-md sm:px-6 md:px-8 lg:px-10 rounded-3xl w-50">
            <div class="flex flex-wrap mb-5">
                <img src="{{ asset('images/logo.jpeg') }}" class="w-8 h-8 rounded-full lg:w-12 lg:h-12"
                    alt="Mrkuku logo">
                <h2 class="ml-1 text-2xl font-semibold text-center text-gray-700 lg:pt-2">Kuku</h2>
            </div>
            <div class="self-center text-lg font-light text-gray-800 sm:text-3xl">
                Invoice Management System
            </div>
            <div class="self-center mt-4 text-lg text-gray-800 sm:text-sm">
                Enter your credentials to access your account
            </div>

            <!--validation errors-->
            @if ($errors->any())
            <div class="mt-4">
                <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>

                <ul class="mt-3 text-sm text-red-600 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <div class="mt-10">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="flex flex-col mb-5">
                        <label for="email" class="mb-1 text-xs tracking-wide text-gray-600">E-Mail Address:</label>
                        <div class="relative">
                            <div
                                class="absolute top-0 left-0 inline-flex items-center justify-center w-10 h-full text-gray-400 ">
                                <i class="text-blue-500 fas fa-at"></i>
                            </div>

                            <input id="email" type="email" name="email"
                                class="w-full py-2 pl-10 pr-4 text-sm placeholder-gray-500 border border-gray-400 rounded-2xl focus:outline-none focus:border-blue-400 @error('email') is-invalid @enderror"
                                placeholder="Enter your email"  value="{{ old('email') }}" required autocomplete="email" autofocus />
                        </div>
                    </div>
                    <div class="flex flex-col mb-6">
                        <label for="password"
                            class="mb-1 text-xs tracking-wide text-gray-600 sm:text-sm">Password:</label>
                        <div class="relative">
                            <div
                                class="absolute top-0 left-0 inline-flex items-center justify-center w-10 h-full text-gray-400 ">
                                <span>
                                    <i class="text-blue-500 fas fa-lock"></i>
                                </span>
                            </div>

                            <input id="password" type="password" name="password"
                                class="w-full py-2 pl-10 pr-4 text-sm placeholder-gray-500 border border-gray-400 rounded-2xl focus:outline-none focus:border-blue-400 @error('password') is-invalid @enderror"
                                placeholder="Enter your password" required autocomplete="current-password"  />
                        </div>
                    </div>
                    <div class="block mt-7">
                        <label for="remember_me" class="inline-flex items-center w-full cursor-pointer">
                            <input name="remember" id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-600">
                                {{ __('Remember me') }}
                            </span>
                        </label>
                    </div>

                    <div class="flex w-full mt-4">
                        <button type="submit"
                            class="flex items-center justify-center w-full py-2 mt-2 text-sm text-white transition duration-150 ease-in bg-blue-500 focus:outline-none sm:text-base hover:bg-blue-600 rounded-2xl">
                            <span class="mr-2 uppercase">Sign In</span>
                            <span>
                                <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @if (Route::has('register'))
        <div class="flex items-center justify-center mt-6">
            <a href="#" target="_blank" class="inline-flex items-center text-xs font-medium text-center text-gray-700 ">
                <span class="ml-2">You don't have an account?
                    <a href="/register" class="ml-2 text-xs font-semibold text-blue-500">Register now</a></span>
            </a>
        </div>
        @endif

    </div>
</body>

</html>
