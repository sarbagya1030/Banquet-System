@php
    use App\Models\images;
    use App\Models\User;
    use App\Models\reviews;
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
            <div><img src="{{ asset('images/logo.png') }}" class="h-12 w-12" alt="logo"></div>
            <ul class="flex space-x-4">
                <li><a href="{{ route('dashboard') }}" class="hover:underline">Home</a></li>
                <li><a href="#" id="openProfile" class="hover:underline">Profile</a></li>
                <li><a href="logout" class="hover:underline">Logout</a></li>
            </ul>
        </div>
    </div>


    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-semibold mb-4">Banquet Listings</h1>

        <div class="flex space-x-4 mb-6">
            <!-- Search Button -->
            <form action="{{ route('search') }}" method="POST">
                @csrf
                <input type="text" id="search" name="search">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">
                    Search
                </button>
            </form>
        </div>
        @if (isset($results))

            <!-- Banquet Cards (Sample Data) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach ($results as $result)
                    @php
                        $pic = images::where('fk_banquet_id', '=', $result->id)->first();
                    @endphp
                    <div class="bg-white rounded shadow-md p-4">
                        @if ($pic)
                            <!-- Check if $pic is not null -->
                            <img src="{{ asset('/banquet/' . $pic->path) }}" alt="Banquet Image" class="rounded-md"
                                style="height: 200px; width: 400px">
                        @else
                            <img src="images/logo.png" alt="Placeholder Image" class="h-12 w-12">
                        @endif
                        <h2 class="text-xl font-semibold">{{ $result->banquetname }}</h2>

                        <!-- Rating Stars -->
                        <div class="flex items-center mt-2">
                            <a href="{{ route('review', $result->id) }}">
                                <span class="text-yellow-400">
                                    @php $rating = $result->rating; @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($rating >= $i)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </span>
                            </a>
                            <span class="ml-2">{{ $result->rating }}</span>
                        </div>

                        {{-- Review --}}
                        {{-- <div class="hidden mt-6" id="reviewsSection">
                            <div class="flex flex-wrap">
                                @php
                                    $reviews = reviews::where('fk_banquet_id', $dat->id)->get();

                                @endphp
                                @if (!$reviews->isEmpty())
                                    @foreach ($reviews as $rev)
                                        @php $user = User::where('id',$rev->fk_user_id)->first();@endphp
                                        <!-- Review Card 1 -->
                                        <div class="w-full h-28 px-3 py-2 border border-gray-300 rounded bg-gray-200">
                                            <p class="text-gray-700 mb-4">{{ $rev->experience }}</p>
                                            <p class="text-gray-500 text-right">
                                                {{ $user->firstname . ' ' . $user->lastname }}
                                            </p>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No Reviews.</p>
                                @endif
                            </div>
                        </div> --}}

                        <!-- See More Button -->
                        <div class="mt-4">
                            <a href="{{ route('show-reviews', $result->id) }}" class="text-blue-400 hover:underline">
                                See Reviews
                            </a>
                        </div>


                        <div class="mt-8">
                            <span class="text-blue-600">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <a href="mailto:{{ $result->email }}"
                                class="text-blue-600 hover:underline">{{ $result->email }}</a>
                        </div>
                        <div class="mt-4">
                            <span class="text-green-600">
                                <i class="fas fa-phone"></i>
                            </span>
                            <a href="tel:{{ $result->contactNumber }}"
                                class="text-blue-600 hover:underline">{{ $result->contactNumber }}</a>
                        </div>
                        <div class="mt-4">
                            <span class="text-red-600">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <a href="{{ $result->location }}"
                                class="text-blue-600 hover:underline">{{ $result->location }}</a>
                        </div>

                        <div class="my-4">
                            <a href="{{ route('booking', $result->id) }}"
                                class="bg-blue-500 text-white hover:bg-blue-600 py-2 px-4 mt-2 rounded-full">
                                Book
                                Now</a>
                        </div>

                    </div>
                @endforeach

            </div>
        @else
            <!-- Banquet Cards (Sample Data) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Sample Banquet Card 1 -->
                @if (!empty($data))
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

                            <!-- Rating Stars -->
                            <div class="flex items-center mt-2">
                                <a href="{{ route('review', $dat->id) }}">
                                    <span class="text-yellow-400">
                                        @php $rating = $dat->rating; @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($rating >= $i)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </span>
                                </a>
                                <span class="ml-2">{{ $dat->rating }}</span>
                            </div>


                            {{-- Review
                            <div class="hidden mt-6" id="reviewsSection">
                                <div class="flex flex-wrap">
                                    @php
                                        $reviews = reviews::where('fk_banquet_id', $dat->id)->get();

                                    @endphp
                                    @if (!$reviews->isEmpty())
                                        @foreach ($reviews as $rev)
                                            @php $user = User::where('id',$rev->fk_user_id)->first();@endphp
                                            <!-- Review Card 1 -->
                                            <div
                                                class="w-full h-28 px-3 py-2 border border-gray-300 rounded bg-gray-200">
                                                <p class="text-gray-700 mb-4">{{ $rev->experience }}</p>
                                                <p class="text-gray-500 text-right">
                                                    -{{ $user->firstname . ' ' . $user->lastname }}
                                                </p>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No Reviews.</p>
                                    @endif
                                </div>
                            </div> --}}


                            <!-- See More Button -->
                            <div class="mt-4">
                                <a href="{{ route('show-reviews', $dat->id) }}" class="text-blue-400 hover:underline">
                                    See Reviews
                                </a>
                            </div>


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

                            <div class="my-4">
                                <a href="{{ route('booking', $dat->id) }}"
                                    class="bg-blue-500 text-white hover:bg-blue-600 py-2 px-4 mt-2 rounded-full">
                                    Book
                                    Now</a>
                            </div>

                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    </div>



    {{-- Profile Dialogue Box --}}
    <div id="profileDialog"
        class="fixed top-0 right-0 h-full w-1/4 bg-white shadow-md transform translate-x-full transition-transform duration-300 ease-in-out overflow-y-scroll">
        <div class="p-4">
            <div class="mt-6 mb-6  max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-center mb-4">
                    <div class="flex items-center space-x-4">
                        <!-- Centered Image -->
                        <div class="flex flex-col items-center"> <!-- Added flex-col class -->
                            <img src="{{ asset('/profile_pictures/' . $user->profile) }}" alt="User Avatar"
                                class="w-16 h-16 rounded-full mb-2"> <!-- Added mb-2 for margin below the image -->
                            <!-- User Name -->
                            <div>
                                <h1 class="text-2xl font-semibold">{{ $user->firstname }} {{ $user->lastname }}</h1>
                            </div>
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
