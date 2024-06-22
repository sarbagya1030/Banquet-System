<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>RegisterPage</title>
    {{-- @vite('resources/css/app.css') --}}
</head>

<body>

    <div class="min-h-screen py-40" style= "background-image: linear-gradient(115deg, #00294A,#0F0E12);">
        <div class="container mx-auto">
            <div
                class=" flex flex-col lg:flex-row w-10/12 lg:8/12 bg-white rounded-xl mx-auto shadow-lg overflow-hidden">
                <div class="w-full lg:w-1/2 flex flex-col items-begin justify-center p-12 bg-no-repeat bg-cover bg-center"
                    style="background-image: url('images/venue.jpg');">
                </div>


                <!-- Register -->
                <div class="w-full lg:1/2 py-16 px-12">
                    <h2 class="text-3xl mb-4">Register</h2>
                    <p class="mb-4">Create an account</p>
                    <form action="{{ route('register-user') }}" method="post">
                        @if (Session::has('success'))
                            <div role="alert"
                                class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3">
                                {{ Session::get('success') }}</div>
                        @endif
                        @if (Session::has('fail'))
                            <div role="alert"
                                class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                                {{ Session::get('fail') }}</div>
                        @endif
                        @csrf
                        <div class="grid grid-cols-2 gap-5">
                            <input type="text" placeholder="Firstname" name="firstname"
                                value="{{ old('firstname') }}" class="border border-gray-400 py-1 px-2 rounded-lg">
                            <span class=" text-red-600">
                                @error('firstname')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="text" placeholder="Lastname" name="lastname" value="{{ old('lastname') }}"
                                class="border border-gray-400 py-1 px-2 rounded-lg">
                            <span class=" text-red-600">
                                @error('lastname')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mt-5">
                            <input type="text" placeholder="Email" name="email" value="{{ old('email') }}"
                                class="border border-gray-400 py-1 px-2 w-full rounded-lg">
                            <span class=" text-red-600">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mt-5">
                            <input type="password" placeholder="Password" name="password"
                                class="border border-gray-400 py-1 px-2 w-full rounded-lg">
                            <span class=" text-red-600">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mt-5">
                            <input type="password" placeholder="Confirm Password" name="password_confirmation"
                                class="border border-gray-400 py-1 px-2 w-full rounded-lg">
                            <span class=" text-red-600">
                                @error('confirm_password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mt-5">
                            <label for="check">Do you want to register your banquet? If yes click on the <a
                                    href="banquetRegister"
                                    class="text-blue-900 font-semibold underline">link</a>.</label>
                        </div>

                        <div class="mt-5">
                            <button
                                class="w-full bg-blue-400 py-3 text-center text-white rounded-lg hover:bg-black hover:text-white">Register
                                Now</button>
                        </div>

                        {{-- <div class="w-full flex items-center justify-center relative py-8">
                <div class="w-full h-[1px] bg-black/20"></div>
                <p class="text-lg absolute text-black/60 bg-[#f5f5f5]">or</p>
              </div> --}}

                        {{-- <div class="mt-2">
                <button class="w-full border border-gray-300 text-md p-2 rounded-lg mb-6 hover:bg-black hover:text-white">
                <img src="images/google.png" alt="img" class="w-6 h-6 inline mr-2">
                Sign in with Google
              </button>
              </div> --}}

                        <div class="w-full flex items-center justify-center mt-2">
                            <span>
                                Already have an account? <a href="login"
                                    class="text-blue-900 font-semibold underline">Login</a>
                            </span>
                        </div>
                    </form>


                </div>

            </div>

        </div>
    </div>
    <script type="module" src="/main.js"></script>
</body>

</html>
