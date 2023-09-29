<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
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

    <!-- Main Content -->
    <div class="container mx-auto py-8">
        <div class="grid grid-rows-1 md:grid-rows-2 lg:grid-rows-4 gap-4">
            @if (!@empty($details))
                @foreach ($details as $detail)
                    <div class="bg-white rounded-lg p-4 shadow-md">
                        <h2 class="text-lg font-semibold mb-2">{{ $detail->banquetname }}</h2>
                        <p>Registration Number: {{ $detail->registrationNumber }}<br>
                            Location: {{ $detail->location }}<br>
                            License Number:{{ $detail->licenseNumber }}<br>
                            Contact Number: {{ $detail->contactNumber }}<br>
                            Email:{{ $detail->email }}<br>
                            Description: {{ $detail->description }} <br>
                            Image: {{ $detail->path }}<br>
                            Date: {{ $detail->date }}<br>
                            Item: {{ $detail->foodname }}<br>
                            type: {{ $detail->type }}<br>
                            price: {{ $detail->price }}<br>
                            capacity: {{ $detail->banquet_capacity }} <br>
                            Parking : {{ $detail->twowheeler }} for 2-wheeler<br>
                            {{ $detail->fourwheeler }} for 4-wheeler<br>
                    </div>
                @endforeach
            @endif
        </div>
    </div>



    <div id="profileDialog"
        class="fixed top-0 right-0 h-full w-80 bg-white shadow-md transform translate-x-full transition-transform duration-300 ease-in-out overflow-y-scroll">
        <div class="p-4">
            <div class="mt-4 max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('/profile_pictures/' . $data->profile) }}" alt="User Avatar"
                            class="w-16 h-16 rounded-full">
                        <div>
                            <h1 class="text-2xl font-semibold">{{ $data->firstname }}</< /h1>
                        </div>
                    </div>
                    <a href="profile"
                        class="ml-2 px-3 py-2 bg-blue-400 text-white rounded-lg hover:bg-black focus:outline-none focus:ring focus:border-blue-300">
                        Edit
                    </a>
                </div>
                <hr class="my-4">
                <div>
                    <h2 class="text-lg font-semibold">About Me</h2>
                    <p class="text-gray-700">{{ $data->bio }}</p>
                </div>

                <div class="mt-4">
                    <h2 class="text-lg font-semibold">Contact Information</h2>
                    <ul class="list-disc list-inside text-gray-700">
                        <li>Email: {{ $data->email }}</li>
                        <li>Contact Number: {{ $data->email }}</li>
                    </ul>
                </div>
            </div>

            <button id="closeProfile" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
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
