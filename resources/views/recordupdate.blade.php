<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Update Record</title>
</head>

<body>
    <!-- Navigation Bar -->
    <div class="p-4 text-white" style="background-image: linear-gradient(115deg, #00294A,#0F0E12);">
        <div class="container mx-auto flex justify-between items-center">
            <div><img src="images/logo.png" class="h-12 w-12" alt="logo"></div>
            <ul class="flex space-x-4">
                <li><a href="dashboard" class="hover:underline">Home</a></li>
                {{-- <li><a href="#" id="profile-link" class="hover:underline">Profile</a></li> --}}
                <li><a href="logout" class="hover:underline">Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="ml-96 w-1/2 p-4">
        <div class="mt-8 p-4 bg-white rounded shadow">
            <h1 class="text-2xl font-semibold mb-6 cursor-pointer" id="creation">Create & Update Record</h1>
            @if (Session::has('success'))
                <div role="alert" class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3">
                    {{ Session::get('success') }}</div>
            @endif
            @if (Session::has('fail'))
                <div role="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ Session::get('fail') }}</div>
            @endif

            <!-- Input fields for creating a new record -->
            <div class="space-x-2" id="fcreate">

                {{-- //food menu --}}
                <div class="max-w-2xl mx-auto mt-8 p-6 bg-white shadow-md rounded-md">
                    <h2 class="text-xl font-semibold mb-4 cursor-pointer">Insert Food Menu</h2>
                    <form id="menu" action="{{ route('menu', Session::get('loginEmail')) }}" method="POST">

                        @csrf

                        <div class="mb-4">
                            <label for="item_name" class="block text-gray-700 font-semibold mb-2">Item Name:</label>
                            <input type="text" id="item_name" name="item_name"
                                class="border rounded-md px-3 py-2 w-full" required>
                            <span class=" text-red-600">
                                @error('item_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-4">
                            <label for="type" class="block text-gray-700 font-semibold mb-2">Type:</label>
                            <input type="radio" id="snacks" name="type" value="snacks">
                            <label for="type" class="mr-8">Snacks</label>
                            <input type="radio" id="dinner" name="type" value="dinner">
                            <label for="type" class="mr-8">Dinner</label>
                            <input type="radio" id="dessert" name="type" value="dessert">
                            <label for="type" class="mr-8">Dessert</label>
                            <span class=" text-red-600">
                                @error('type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-gray-700 font-semibold mb-2">Price:</label>
                            <input type="number" id="price" name="price"
                                class="border rounded-md px-3 py-2 w-full" step="0.01" required>
                            <span class=" text-red-600">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


                        <div class="mt-6">
                            <button type="submit"
                                class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add
                                Items</button>
                        </div>
                    </form>
                </div>


                {{-- //available-dates --}}
                <div class="max-w-2xl mx-auto mt-8 p-6 bg-white shadow-md rounded-md">
                    <h2 class="text-xl font-semibold mb-4 cursor-pointer">Insert Available Dates</h2>
                    <form id="dates" method="POST" action="{{ route('date', Session::get('loginEmail')) }}">
                        @csrf
                        <div class="mb-4">
                            <label for="dates" class="block text-gray-700 font-semibold mb-2">Available Date:</label>
                            <input type="date" id="dates" name="dates"
                                class="border rounded-md px-3 py-2 w-full" required>
                            <span class=" text-red-600">
                                @error('dates')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


                        <div class="mt-6">
                            <button type="submit"
                                class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add
                                Date</button>
                        </div>
                    </form>
                </div>



                {{-- multiple images --}}
                <div class="max-w-2xl mx-auto mt-8 p-6 bg-white shadow-md rounded-md">
                    <h2 class="text-xl font-semibold mb-4 cursor-pointer">Upload Images</h2>
                    <form id="images" action="{{ route('image', Session::get('loginEmail')) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="images" class="block text-gray-700 font-semibold mb-2">Select Image:</label>
                            <input type="file" id="images" name="images"
                                class="border rounded-md px-3 py-2 w-full" required>
                            <span class=" text-red-600">
                                @error('images')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mt-6">
                            <button type="submit"
                                class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add
                                Image</button>
                        </div>
                    </form>
                </div>


                {{-- //capacity --}}
                <div class="max-w-2xl mx-auto mt-8 p-6 bg-white shadow-md rounded-md">
                    <h2 class="text-xl font-semibold mb-4 cursor-pointer">Banquet Capacity</h2>

                    <form id="capacity" method="POST"
                        action="{{ route('capacity', Session::get('loginEmail')) }}">
                        @csrf
                        <div class="mb-4">
                            <label for="banquet_capacity" class="block text-gray-700 font-semibold mb-2">Banquet
                                Capacity:</label>
                            <input type="number" id="banquet_capacity" name="banquet_capacity"
                                class="border rounded-md px-3 py-2 w-full" required>
                            <span class=" text-red-600">
                                @error('banquet_capacity')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-4">
                            <label for="two_wheeler_capacity"
                                class="block text-gray-700 font-semibold mb-2">Two-Wheeler Capacity:</label>
                            <input type="number" id="two_wheeler_capacity" name="two_wheeler_capacity"
                                class="border rounded-md px-3 py-2 w-full" required>
                            <span class=" text-red-600">
                                @error('two_wheeler_capacity')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-4">
                            <label for="four_wheeler_capacity"
                                class="block text-gray-700 font-semibold mb-2">Four-Wheeler Capacity:</label>
                            <input type="number" id="four_wheeler_capacity" name="four_wheeler_capacity"
                                class="border rounded-md px-3 py-2 w-full" required>
                            <span class=" text-red-600">
                                @error('four_wheeler_capacity')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mt-6">
                            <button type="submit"
                                class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add
                                Capacity</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

</body>

</html>
