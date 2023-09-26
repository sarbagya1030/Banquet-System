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
        <div class= "p-4 text-white" style= "background-image: linear-gradient(115deg, #00294A,#0F0E12);">
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
                @foreach ($Banquet as $item)
                <div class="bg-white rounded-lg p-4 shadow-md">
                    <h2 class="text-lg font-semibold mb-2">{{$item->banquetname}}</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                @endforeach
            </div>
        </div>
        


        <div id="profileDialog" class="fixed top-0 right-0 h-full w-80 bg-white shadow-md transform translate-x-full transition-transform duration-300 ease-in-out overflow-y-scroll">
            <div class="p-4">
                <div class="mt-4 max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <img src="{{asset('/profile_pictures/' . $data->profile)}}" alt="User Avatar" class="w-16 h-16 rounded-full">
                            <div>
                                <h1 class="text-2xl font-semibold">{{$data->firstname}}</</h1>
                            </div>
                        </div>
                        <a href="profile" class="px-2 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                            Edit Profile
                        </a>
                    </div>
                    <hr class="my-4">
                    <div>
                        <h2 class="text-lg font-semibold">About Me</h2>
                        <p class="text-gray-700">{{$data->bio}}</p>
                    </div>
            
                    <div class="mt-4">
                        <h2 class="text-lg font-semibold">Contact Information</h2>
                        <ul class="list-disc list-inside text-gray-700">
                            <li>Email: {{$data->email}}</li>
                            <li>Contact Number: {{$data->email}}</li>
                        </ul>
                    </div>
                </div>
                <button id="closeProfile" class="bg-blue-500 text-white py-2 px-4 mt-6 ml-16 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-red-300">
                    Close Profile
                </button>
            </div>

           


<style>
    /* Styles for the profile dialog container */
    #profileDialog {
            z-index: 9999; /* Ensure it appears above other content */
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