@php
    use App\Models\images;
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Dashboard</title>
</head>

<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <div class="p-4 text-white" style="background-image: linear-gradient(115deg, #00294A,#0F0E12);">
        <div class="container mx-auto flex justify-between items-center">
            <div><img src="images/logo.png" class="h-12 w-12" alt="logo"></div>
            <ul class="flex space-x-4">
                <li><a href="dashboard" class="hover:underline">Home</a></li>
                <li><a href="#" id="openProfile" class="hover:underline">Profile</a></li>
                <li><a href="logout" class="hover:underline">Logout</a></li>
            </ul>
        </div>
    </div>


    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-semibold mb-4">Banquet Listings</h1>

        <!-- Search Bar -->
        <div class="mb-4">
            <input type="text" class="border rounded py-2 px-4 w-full" placeholder="Search banquets...">
        </div>

        <!-- Banquet Cards (Sample Data) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Sample Banquet Card 1 -->

            @if (!@empty($data))
                @foreach ($data as $dat)
                    @php
                        $pic = images::where('fk_banquet_id', '=', $dat->id)->first();
                        // dd($pic->path);
                    @endphp
                    <div class="bg-white rounded shadow-md p-4">
                        @if ($pic)
                            <!-- Check if $pic is not null -->
                            <img src="{{ asset('/banquet/' . $pic->path) }}" alt="Banquet Image" class="rounded-md"
                                style="height: 200px; width: 400px">
                        @else
                            <img src="images/logo.png" alt="Placeholder Image" class="h-12 w-12">
                        @endif
                        <h2 class="text-xl font-semibold">{{ $dat->banquetname }}</h2>
                        <div class="mt-8">
                            <span class="text-blue-600">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <a href="mailto:{{ $dat->email }}"
                                class="text-blue-600 hover:underline">{{ $dat->email }}</a>
                        </div>

                        <div class="mt-4">
                            <span class="text-green-600">
                                <i class="fas fa-phone"></i>
                            </span>
                            <a href="tel:{{ $dat->contactNumber }}"
                                class="text-blue-600 hover:underline">{{ $dat->contactNumber }}</a>
                        </div>

                        <div class="mt-4">
                            <span class="text-red-600">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <a href="{{ $dat->location }}"
                                class="text-blue-600 hover:underline">{{ $dat->location }}</a>
                        </div>
                        <button class="bg-blue-500 text-white hover:bg-blue-600 py-2 px-4 mt-2 rounded-full">Book
                            Now</button>
                    </div>
                @endforeach
            @endif


            <!-- Add more banquet cards as needed -->
        </div>
    </div>
</body>







{{-- <body class="bg-gray-100">

    <!-- Main Content -->
    <div class="container mx-auto py-8">
        <div class="grid grid-rows-1 gap-4">
            @if (!@empty($data))
                @foreach ($data as $dat)
                    <div class="bg-white rounded-lg p-4 shadow-md">
                        <h2 class="text-lg font-semibold mb-2">{{ $dat->banquetname }}</h2>
                        <p>Registration Number: {{ $dat->registrationNumber }}<br>
                            Location: {{ $dat->location }}<br>
                            License Number:{{ $dat->licenseNumber }}<br>
                            Contact Number: {{ $dat->contactNumber }}<br>
                            Email:{{ $dat->email }}<br>
                            Description: {{ $dat->description }} <br> </p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="container mx-auto py-8">
        <div class="grid grid-rows-1  gap-4">
            @if (!@empty($capacity))
                @foreach ($capacity as $cap)
                    <div class="bg-white rounded-lg p-4 shadow-md">
                        <h2 class="text-lg font-semibold mb-2">Capacity</h2>
                        <p>Banquet Capacity: {{ $cap->banquet_capacity }}<br>
                            Two-wheeler capacity: {{ $cap->twowheeler }}<br>
                            Four-wheeler capacity: {{ $cap->fourwheeler }}<br> </p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="container mx-auto py-8">
        <div class="grid grid-rows-1  gap-4">
            @if (!@empty($dates))
                @foreach ($dates as $dt)
                    <div class="bg-white rounded-lg p-4 shadow-md">
                        <h2 class="text-lg font-semibold mb-2">Available Dates</h2>
                        <p>Dates: {{ $dt->date }}<br></p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="container mx-auto py-8">
        <div class="grid grid-rows-1  gap-4">
            @if (!@empty($image))
                @foreach ($image as $im)
                    <div class="bg-white rounded-lg p-4 shadow-md">
                        <h2 class="text-lg font-semibold mb-2">Images</h2>
                        <img src="{{ asset('/banquet/' . $im->path) }}" alt="banquet" class="w-16 h-16">
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="container mx-auto py-8">
        <div class="grid grid-rows-1  gap-4">
            @if (!@empty($menu))
                @foreach ($menu as $mn)
                    <div class="bg-white rounded-lg p-4 shadow-md">
                        <h2 class="text-lg font-semibold mb-2">Menu</h2>
                        <p>
                            Item name: {{ $mn->foodname }}<br>
                            Type: {{ $mn->type }}<br>
                            Price: {{ $mn->price }} <br>


                        </p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>




    {{-- Profile Dialogue Box --}}
<div id="profileDialog"
    class="fixed top-0 right-0 h-full w-80 bg-white shadow-md transform translate-x-full transition-transform duration-300 ease-in-out overflow-y-scroll">
    <div class="p-4">
        <div class="mt-6 mb-6  max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('/profile_pictures/' . $user->profile) }}" alt="User Avatar"
                        class="w-16 h-16 rounded-full">
                    <div>
                        <h1 class="text-2xl font-semibold">{{ $user->firstname }}</< /h1>
                    </div>
                </div>

            </div>
            <hr class="my-4">
            <div>
                <h2 class="text-lg font-semibold">About Me</h2>
                <p class="text-gray-700">{{ $user->bio }}</p>
            </div>

            <div class="mt-4">
                <h2 class="text-lg font-semibold">Contact Information</h2>
                <ul class="list-disc list-inside text-gray-700">
                    <li>Email: {{ $user->email }}</li>
                    <li>Contact Number: {{ $user->email }}</li>
                </ul>
            </div>
        </div>

        <button id="closeProfile" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="flex justify-center">
            <a href="profile"
                class="ml-2 px-3 py-2 bg-blue-400 text-white rounded-lg hover:bg-black focus:outline-none focus:ring focus:border-blue-300">
                Edit Profile
            </a>
        </div>
    </div>




    <style>
        /* Styles for the profile dialog container */
        #profileDialog {
            z-index: 9999;
            /* Ensure it appears above other content */
        }

        /* Initial position of the profile dialog */
        .translate-x-full {
            transform: translateX(100%);
        }
    </style>



    <script>
        // Function to open the profile dialog
        function openProfile() {
            const profileDialog = document.getElementById("profileDialog");
            profileDialog.classList.remove("translate-x-full");
        }

        // Function to close the profile dialog
        function closeProfile() {
            const profileDialog = document.getElementById("profileDialog");
            profileDialog.classList.add("translate-x-full");
        }

        // Add event listeners to open and close the profile dialog
        const openProfileLink = document.getElementById("openProfile");
        openProfileLink.addEventListener("click", openProfile);

        const closeProfileButton = document.getElementById("closeProfile");
        closeProfileButton.addEventListener("click", closeProfile);
    </script>

    </body>

</html>
