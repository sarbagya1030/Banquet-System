<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RegisterBanquet</title>
    @vite('resources/css/app.css')
</head>

<body>

    <div class="min-h-screen py-40" style="background-image: linear-gradient(115deg, #00294A,#0F0E12);">
        <div class="container mx-auto">
            <div
                class=" flex flex-col lg:flex-row w-10/12 lg:8/12 bg-white rounded-xl mx-auto shadow-lg overflow-hidden">
                <div class="w-full lg:w-1/2 flex flex-col items-begin justify-center p-12 bg-no-repeat bg-cover bg-center"
                    style="background-image: url('images/venue.jpg');">
                    {{-- <h1 class="text-white text-5xl mb-1 font-bold">Welcome</h1> --}}
                </div>


                <!-- Register -->
                <div class="w-full lg:1/2 py-16 px-12">
                    <h2 class="text-3xl mb-4">Register Banquet</h2>
                    <form action="{{ route('register-owner') }}" method="post">
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
                            <input type="text" placeholder="Banquetname" name="banquetname"
                                value="{{ old('Banquetname') }}" class="border border-gray-400 py-1 px-2 rounded-lg">
                            <span class=" text-red-600">
                                @error('banquetname')
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
                            <input type="text" placeholder="Address" name="location" value="{{ old('location') }}"
                                class="border border-gray-400 py-1 px-2 w-full rounded-lg">
                            <span class=" text-red-600">
                                @error('location')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mt-5">
                            <input type="text" placeholder="RegistrationNumber" name="registrationNumber"
                                value="{{ old('registrationNumber') }}"
                                class="border border-gray-400 py-1 px-2 w-full rounded-lg">
                            <span class=" text-red-600">
                                @error('registrationNumber')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mt-5">
                            <input type="text" placeholder="LicenseNumber" name="licenseNumber"
                                value="{{ old('licenseNumber') }}"
                                class="border border-gray-400 py-1 px-2 w-full rounded-lg">
                            <span class=" text-red-600">
                                @error('licenseNumber')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mt-5">
                            <input type="number" placeholder="ContactNumber" name="contactNumber"
                                value="{{ old('contactNumber') }}"
                                class="border border-gray-400 py-1 px-2 w-full rounded-lg">
                            <span class=" text-red-600">
                                @error('contactNumber')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mt-5">
                            <textarea placeholder="Enter a description" name="description" value="{{ old('description') }}"
                                class="h-32 border border-gray-400 py-1 px-2 w-full rounded-lg"></textarea>
                            <span class=" text-red-600">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mt-5">
                            <input type="number" placeholder="Bookingamount" name="bookingamount"
                                value="{{ old('bookingamount') }}"
                                class="border border-gray-400 py-1 px-2 w-full rounded-lg">
                            <span class=" text-red-600">
                                @error('bookingamount')
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
