<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <title>UpdateProfile</title>
</head>
<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <div class= "p-4 text-white" style= "background-image: linear-gradient(115deg, #00294A,#0F0E12);">
        <div class="container mx-auto flex justify-between items-center">
            <div><img src="images/logo.png" class="h-12 w-12" alt="logo"></div>
            <ul class="flex space-x-4">
                <li><a href="dashboard" class="hover:underline">Home</a></li>
                <li><a href="logout" class="hover:underline">Logout</a></li>
            </ul>
        </div>
    </div>


    {{-- UpdateProfile --}}
    <div class="mt-6 max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-4">Update Your Profile</h1>
        <form action="profileUpdateUser" method="POST" class="space-y-4" enctype="multipart/form-data">
              @if(Session::has('success'))
              <div role="alert" class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3">{{Session::get('success')}}</div>
              @endif
              @if(Session::has('fail'))
              <div role="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">{{Session::get('fail')}}</div>
              @endif
            @csrf
            @method('PUT')
            <div>
                <label for="firstname" class="block text-gray-700 font-semibold">Firstname</label>
                <input type="text" id="firstname" name="firstname" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-500" value="{{$data->firstname}}">
                <span class=" text-red-600">@error('firstname') {{$message}} @enderror</span>
            </div>
            <div>
                <label for="lastname" class="block text-gray-700 font-semibold">Lastname</label>
                <input type="text" id="lastname" name="lastname" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-500" value="{{$data->lastname}}">
                <span class=" text-red-600">@error('lastname') {{$message}} @enderror</span>
            </div>
            <div>
                <label for="password" class="block text-gray-700 font-semibold">Password</label>
                <input type="password" id="password" name="password" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-500">
                <span class=" text-red-600">@error('password') {{$message}} @enderror</span>
            </div>
            <div>
                <label for="confirm_password" class="block text-gray-700 font-semibold">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-500">
                <span class=" text-red-600">@error('password_confirmation') {{$message}} @enderror</span>
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input type="email" id="email" name="email" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-500" value="{{$data->email}}">
                <span class=" text-red-600">@error('email') {{$message}} @enderror</span>
            </div>
            <div>
                <label for="bio" class="block text-gray-700 font-semibold">Bio</label>
                <textarea id="bio" name="bio" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-500" placeholder="Tell us about yourself"></textarea>
                <span class=" text-red-600">@error('bio') {{$message}} @enderror</span>
            </div>
            <div>
                <label for="profile" class="block text-gray-700 font-semibold">Profile Picture</label>
                <input type="file" id="profile" name="profile" class="w-full">
                <span class=" text-red-600">@error('profile') {{$message}} @enderror</span>
            </div>
            <div>
                <button type="submit" class="w-full bg-blue-400 text-white py-2 px-4 rounded-md hover:bg-black focus:outline-none focus:ring focus:border-blue-300">
                    Update Profile
                </button>
            </div>
        </form>
    </div>

</body>
</html>