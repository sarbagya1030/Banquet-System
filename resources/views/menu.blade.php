<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu Edit</title>
</head>

<body class="bg-gray-100">
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


    <div class="flex justify-center min-h-screen mt-12">
        <div class="w-3/4">
            <h1 class="text-2xl flex justify-center font-semibold mb-4">Available Dates</h1>
            <table class="w-full bg-white border">
                <thead>
                    <tr>
                        <th class="border p-4">Date</th>
                        <th class="border p-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($select as $sc)
                        <tr>
                            <td class="border p-4 text-center">{{ $sc->date }}</td>
                            <td class="flex justify-center border p-4">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">Edit</button>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg">Delete</button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
