<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Profile Owner</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <!-- Navigation Bar -->
    <div class="p-4 text-white" style="background-image: linear-gradient(115deg, #00294A,#0F0E12);">
        <div class="container mx-auto flex justify-between items-center">
            <div><img src="images/logo.png" class="h-12 w-12" alt="logo"></div>
            <ul class="flex space-x-4">
                <li><a href="dashboardOwner" class="hover:underline">Home</a></li>
                <li><a href="#" id="profile-link" class="hover:underline">Profile</a></li>
                <li><a href="logout" class="hover:underline">Logout</a></li>
            </ul>
        </div>
    </div>

    {{-- UpdateProfile --}}
    <div class="mt-6 max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-4">Update Your Profile</h1>
        <form action="{{ route('updateProfile-owner') }}" method="POST" class="space-y-4"
            enctype="multipart/form-data">
            @if (Session::has('success'))
                <div role="alert" class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3">
                    {{ Session::get('success') }}</div>
            @endif
            @if (Session::has('fail'))
                <div role="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ Session::get('fail') }}</div>
            @endif
            @csrf
            @method('PUT')
            <div>
                <label for="banquetname" class="block text-gray-700 font-semibold">Banquet Name</label>
                <input type="text" id="banquetname" name="banquetname"
                    class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-500"
                    value="{{ $value->banquetname }}">
                <span class=" text-red-600">
                    @error('banquetname')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input type="text" id="email" name="email" value="{{ $value->email }}"
                    class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-500">
                <span class=" text-red-600">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div>
                <label for="location" class="block text-gray-700 font-semibold">Address</label>
                <input type="text" id="location" name="location" value="{{ $value->location }}"
                    class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-500">
                <span class=" text-red-600">
                    @error('location')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div>
                <label for="registrationNumber" class="block text-gray-700 font-semibold">Registration Number</label>
                <input type="text" id="registrationNumber" name="registrationNumber"
                    value="{{ $value->registrationNumber }}"
                    class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-500">
                <span class=" text-red-600">
                    @error('registrationNumber')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div>
                <label for="licenseNumber" class="block text-gray-700 font-semibold">License Number</label>
                <input type="text" id="licenseNumber" name="licenseNumber" value="{{ $value->licenseNumber }}"
                    class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-500">
                <span class=" text-red-600">
                    @error('licenseNumber')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div>
                <label for="contactNumber" class="block text-gray-700 font-semibold">Contact Number</label>
                <input type="number" id="contactNumber" name="contactNumber" value="{{ $value->contactNumber }}"
                    class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-500">
                <span class=" text-red-600">
                    @error('contactNumber')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div>
                <label for="description" class="block text-gray-700 font-semibold">Description</label>
                <textarea type="number" id="description" name="description"
                    class="w-full h-32 border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-500">{{ $value->description }}</textarea>
                <span class=" text-red-600">
                    @error('description')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div>
                <label for="password" class="block text-gray-700 font-semibold">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-500">
                <span class=" text-red-600">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div>
                <label for="password" class="block text-gray-700 font-semibold">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-500">
                <span class=" text-red-600">
                    @error('password_confirmation')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-blue-400 text-white py-2 px-4 rounded-md hover:bg-black focus:outline-none focus:ring focus:border-blue-300">
                    Update Profile
                </button>
            </div>

            <div>
                <button type="delete"
                    class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-black focus:outline-none focus:ring focus:border-blue-300">
                    Delete Profile
                </button>
            </div>
        </form>
    </div>


</body>

</html>
