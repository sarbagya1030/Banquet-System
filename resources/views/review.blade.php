<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Review</title>
</head>

<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <div class="p-4 text-white" style="background-image: linear-gradient(115deg, #00294A,#0F0E12);">
        <div class="container mx-auto flex justify-between items-center">
            <div><img src="{{ asset('images/logo.png') }}" class="h-12 w-12" alt="logo"></div>
            <ul class="flex space-x-4">
                <li><a href="{{ route('dashboard') }}" class="hover:underline">Home</a></li>
                <li><a href="logout" class="hover:underline">Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg max-w-md w-full">

            @if (Session::has('success'))
                <div role="alert" class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3">
                    {{ Session::get('success') }}</div>
            @endif
            @if (Session::has('fail'))
                <div role="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ Session::get('fail') }}</div>
            @endif
            <h2 class="text-2xl font-semibold text-center mb-4">Write a Review</h2>
            <div class="flex justify-center space-x-2 mb-4 text-3xl cursor-pointer">
                <span class="star" onclick="setRating(1)">&#9733;</span>
                <span class="star" onclick="setRating(2)">&#9733;</span>
                <span class="star" onclick="setRating(3)">&#9733;</span>
                <span class="star" onclick="setRating(4)">&#9733;</span>
                <span class="star" onclick="setRating(5)">&#9733;</span>
            </div>
            <form action="{{ route('review-post', $id) }}" method="POST">
                @csrf
                <input type="number" id="ratings" name="rating" hidden required />
                <textarea id="review-text" class="w-full h-32 px-3 py-2 border border-gray-300 rounded"
                    placeholder="Write your review here" name="description" required></textarea>
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white text-center font-bold py-2 px-4 rounded mt-4">
                    Submit Review</button>
            </form>
        </div>
    </div>

</body>

<script type="text/javascript">
    const ratingVal = document.getElementById('ratings');
    ratingVal.value = 0;

    // Function to set the star rating
    function setRating(rating) {
        const stars = document.querySelectorAll('.star');
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add('text-yellow-500');
            } else {
                star.classList.remove('text-yellow-500');
            }
        });
        ratingVal.value = document.querySelectorAll('.star.text-yellow-500').length;

    }
</script>

</html>
