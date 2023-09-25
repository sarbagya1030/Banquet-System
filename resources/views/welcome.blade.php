<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
  <title>HomePage</title>
</head>
<body style= "background-image: linear-gradient(115deg, #00294A,#0F0E12);" class="bg-gray-100">

  <!-- Navigation Bar -->
  <div class= "p-4 text-white" >
      <div class="container mx-auto flex justify-between items-center ">
          <div><img src="images/logo.png" class="h-12 w-12" alt="logo"></div>
          <ul class="flex space-x-4">
              <li><a href="#" id="about-us-link" class="hover:underline">About Us</a></li>
              <li><a href="#" id="contact-us-link" class="hover:underline">Contact</a></li>
          </ul>
      </div>
  </div>


   <!-- Hero section -->
   <section class=" text-white py-16">

    <div class="container mx-auto text-center">
        <h1 class="text-5xl font-bold mb-3">BOOK YOUR DESIRED BANQUET</h1>
        <h2 class="text-3xl font-bold mb-8">with YETA Booking Website</h2>
        <p class="mt-4 text-lg mb-12">Join us for an unforgettable evening of food, music, and fun!</p>
        <a href="registration" class="mt-6 inline-block bg-blue-400 text-blue-900 hover:bg-yellow-400 hover:text-blue-800 px-6 py-3 rounded-full font-semibold transition duration-300">Register Now</a>
    </div>
</section>

//images upload
<div class="grid grid-cols-3 gap-4">
    <div class="relative group">
      <img src="images/image1.jpg" alt="Image 1" class="w-full h-auto rounded-lg">
      <div class="absolute top-0 left-0 w-full h-full bg-black opacity-0 group-hover:opacity-75 transition-opacity">
        <!-- Add any content or overlay you want -->
      </div>
    </div>
    <div class="relative group">
      <img src="images/image2.jpg" alt="Image 2" class="w-full h-auto rounded-lg">
      <div class="absolute top-0 left-0 w-full h-full bg-black opacity-0 group-hover:opacity-75 transition-opacity">
        <!-- Add any content or overlay you want -->
      </div>
    </div>
    <div class="relative group">
      <img src="images/image3.jpg" alt="Image 3" class="w-full h-auto rounded-lg">
      <div class="absolute top-0 left-0 w-full h-full bg-black opacity-0 group-hover:opacity-75 transition-opacity">
        <!-- Add any content or overlay you want -->
      </div>
    </div>
    <div class="relative group">
        <img src="images/image4.jpg" alt="Image 1" class="w-full h-auto rounded-lg">
        <div class="absolute top-0 left-0 w-full h-full bg-black opacity-0 group-hover:opacity-75 transition-opacity">
          <!-- Add any content or overlay you want -->
        </div>
      </div>
      <div class="relative group">
        <img src="images/image5.jpg" alt="Image 1" class="w-full h-auto rounded-lg">
        <div class="absolute top-0 left-0 w-full h-full bg-black opacity-0 group-hover:opacity-75 transition-opacity">
          <!-- Add any content or overlay you want -->
        </div>
      </div>
    <!-- Add more grid items as needed -->
  </div>

  
  <section class="bg-gray-100 py-16">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- About Us Column -->
        <div id="about-us-section" class="max-w-md">
          <h2 class="text-3xl font-semibold mb-4">About Us</h2>
          <p class="text-gray-600">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, augue eget interdum condimentum, elit justo convallis odio, id venenatis dolor eros non nulla.
          </p>
          <p class="text-gray-600 mt-4">
            Vestibulum vehicula dolor in bibendum. Proin sed cursus elit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
          </p>
        </div>
        
        <!-- Contact Us Column -->
        <div id="contact-us-section" class="max-w-md">
          <h2 class="text-3xl font-semibold mb-4">Contact Us</h2>
          <p class="text-gray-600">
            We would love to hear from you! If you have any questions or inquiries, please do contact us.
          </p>
          <div class="mt-8">
            <p class="text-gray-600 mb-2">Email:</p>
            <a href="mailto:sarbagya.sapkota@gmail.com" class="text-blue-600 hover:underline">sarbagya.sapkota@gmail.com</a>
          </div>
          <div class="mt-4">
            <p class="text-gray-600 mb-2">Phone:</p>
            <a href="tel:+977-9803546282" class="text-blue-600 hover:underline">+977-9803546282</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  

<!-- Footer -->
<footer class=" text-white py-8">
    <div class="container mx-auto text-center">
        <p>&copy; 2023 Banquet Registration System</p>
    </div>
</footer>

<script>
//about us
const aboutUsLink = document.getElementById("about-us-link"); // Get a reference to the "About Us" link
const aboutUsSection = document.getElementById("about-us-section"); // Get a reference to the section you want to scroll to
aboutUsLink.addEventListener("click", () => { // Add a click event listener to the "About Us" link
    aboutUsSection.scrollIntoView({ behavior: "smooth" }); // Scroll to the "About Us" section with a smooth behavior
});

//contact us
const contactUsLink = document.getElementById("contact-us-link"); 
const contactUsSection = document.getElementById("contact-us-section"); 
contactUsLink.addEventListener("click", () => { 
    contactUsSection.scrollIntoView({ behavior: "smooth" }); 
});

</script>
</body> 
</html>
