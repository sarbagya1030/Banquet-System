@php
    use App\Models\User;
    use App\Models\reviews;
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
    <title>Show Review</title>
</head>

<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <div class="p-4 text-white" style="background-image: linear-gradient(115deg, #00294A,#0F0E12);">
        <div class="container mx-auto flex justify-between items-center">
            <div><img src="{{ asset('images/logo.png') }}" class="h-12 w-12" alt="logo"></div>
            <ul class="flex space-x-4">
                <li><a href="{{ route('dashboard') }}" class="hover:underline">Home</a></li>
                {{-- <li><a href="#" id="openProfile" class="hover:underline">Profile</a></li> --}}
                <li><a href="logout" class="hover:underline">Logout</a></li>
            </ul>
        </div>
    </div>

    {{-- <div class="min-h-screen flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold mb-4">User Reviews</h1>
        <div class="border p-4">
            <div class="flex flex-wrap gap-4 justify-center">
                @if (!$reviews->isEmpty())
                    @foreach ($reviews as $rev)
                        @php $user = User::where('id',$rev->fk_user_id)->first();@endphp
                        <!-- Review Card -->
                        <div class="bg-white rounded-lg shadow-md p-4 flex-shrink-0 w-80 mb-4">
                            <p class="text-gray-800 mb-2">{{ $rev->experience }}</p>
                            <p class="text-gray-600 text-right">
                                -{{ $user->firstname . ' ' . $user->lastname }}
                            </p>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-600">No Reviews.</p>
                @endif
            </div>
        </div>
    </div> --}}


    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-3xl w-full bg-white rounded-lg shadow-md p-6 space-y-4">
            <h1 class="text-2xl font-bold mb-4">User Reviews</h1>
            <!-- Example review in comment format -->
            <div class="bg-gray-200 rounded-lg p-4">
                @if (!$reviews->isEmpty())
                    @foreach ($reviews as $rev)
                        @php $user = User::where('id',$rev->fk_user_id)->first();@endphp
                        <div class="flex items-start mb-2">
                            <img src="{{ asset('profile_pictures/' . $user->profile) }}" alt="User Avatar"
                                class="w-12 h-12 rounded-full mr-3">
                            <div>
                                <p class="text-gray-800 font-bold"> {{ $user->firstname . ' ' . $user->lastname }}</p>
                                <p class="text-gray-600">{{ date('M d, Y', strtotime($rev->created_at)) }}</p>
                            </div>
                            </br>
                        </div>
                        <p class="text-gray-700 mb-4">"{{ $rev->experience }}"</p>
                    @endforeach
                @else
                    <p class="text-gray-600">No Reviews.</p>
                @endif
            </div>

        </div>
    </div>




</body>

</html>
