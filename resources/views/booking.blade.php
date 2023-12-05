<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Booking</title>
</head>

<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <div class="p-4 text-white" style="background-image: linear-gradient(115deg, #00294A,#0F0E12);">
        <div class="container mx-auto flex justify-between items-center">
            <div><img src="{{ asset('images/logo.png') }}" class="h-12 w-12" alt="logo"></div>
            <ul class="flex space-x-4">
                <li><a href="{{ route('dashboard') }}" class="hover:underline">Home</a></li>
                {{-- <li><a href="#" id="openProfile" class="hover:underline">Profile</a></li> --}}
                <li><a href="{{ route('logout') }}" class="hover:underline">Logout</a></li>
            </ul>
        </div>
    </div>
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-semibold mb-4">Banquet Booking</h1>

        <!-- Booking Form -->
        <form class="bg-white rounded p-4 shadow-md" action="{{ route('book-order', $id) }}" method="POST">
            @if (Session::has('success'))
                <div role="alert" class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3">
                    {{ Session::get('success') }}</div>
            @endif
            @if (Session::has('fail'))
                <div role="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ Session::get('fail') }}</div>
            @endif
            @csrf
            <div class="mb-4">
                <label for="firstname" class="block text-sm font-medium text-gray-700">Firstname</label>
                <input type="text" id="firstname" name="firstname" class="form-input" value="{{ $user->firstname }}">
                <span class=" text-red-600">
                    @error('firstname')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="mb-4">
                <label for="lastname" class="block text-sm font-medium text-gray-700">Lastname</label>
                <input type="text" id="lastname" name="lastname" class="form-input" value="{{ $user->lastname }}">
                <span class=" text-red-600">
                    @error('lastname')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ $user->email }}">
                <span class=" text-red-600">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="tel" id="phone" name="phone" class="form-input">
                <span class=" text-red-600">
                    @error('phone')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>

                <!-- Dropdown Button with Options -->
                <div class="relative inline-block w-full text-gray-700">
                    <div class="relative">
                        <select id="date" name="date"
                            class="block appearance-none w-full bg-white border border-gray-300 px-4 py-2 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            @foreach ($date as $dat)
                                <option value="{{ $dat->date }}">{{ $dat->date }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <span class="text-red-600">
                    @error('date')
                        {{ $message }}
                    @enderror
                </span>
            </div>


            <div class="mb-4">
                <label for="guests" class="block text-sm font-medium text-gray-700">Number of Guests</label>
                <input type="number" min="0" max="{{ $capacity->banquet_capacity }}" id="guests"
                    name="guests" class="form-input">
            </div>


            <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg"
                type="submit">Continue with Payment
            </button>
        </form>
    </div>


</body>

</html>
