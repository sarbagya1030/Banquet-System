<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Dashboard_Owner</title>
</head>
<body class="bg-gray-100">
     <!-- Navigation Bar -->
     <div class= "p-4 text-white" style= "background-image: linear-gradient(115deg, #00294A,#0F0E12);">
        <div class="container mx-auto flex justify-between items-center">
            <div><img src="images/logo.png" class="h-12 w-12" alt="logo"></div>
            <ul class="flex space-x-4">
                <li><a href="dashboardOwner" class="hover:underline">Home</a></li>
                <li><a href="#" id="profile-link" class="hover:underline">Profile</a></li>
                <li><a href="logout" class="hover:underline">Logout</a></li>
            </ul>
        </div>
      </div>


        <div class= "p-12">
        <div class="mb-6 ml-0 max-w-full mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-center text-2xl font-bold mb-4">{{$data->banquetname}}</h2>

             <!-- License Number and Registration Number -->
            <div class="max-w-3xl mx-auto bg-blue-100 rounded-lg p-6 h-16 flex items-center">
                <div class="w-1/2 pr-4">
                  <strong>License Number:</strong> {{$data->licenseNumber}}
                </div>
                <div class="w-1/2 pl-4 border-l border-gray-400">
                  <strong>Registration Number:</strong>  {{$data->registrationNumber}}
                </div>
            </div>
          
          

        {{-- banquet Details --}}
            <div class="p-4">
                  <hr class="my-2">
                  <div>
                      <p class="text-gray-700">{{$data->description}}</p>
                  </div>
            </div>
        
         <!-- Images Section -->
          <div class="grid grid-cols-3 gap-4">
          @foreach($image as $im)

          <img src="{{asset('/banquet/'.$im->path)}}" alt="Image 1" class="rounded-lg">
          @endforeach


          </div>
        </div>
       
        
        
    
        <!-- Available Dates Section -->
        <div class="mb-6 ml-0 max-w-full mx-auto bg-white rounded-lg shadow-md p-6">
          <h3 class="text-2xl font-semibold mb-4">Available Dates</h3>
         
          <ul>
          <li><i class="far fa-calendar text-1xl text-blue-500 mr-2"></i>Available Date 1</li>
          <li><i class="far fa-calendar text-1xl text-blue-500 mr-2"></i>Available Date 1</li>
          <li><i class="far fa-calendar text-1xl text-blue-500 mr-2"></i>Available Date 1</li>
          </ul>
        </div>
    
  
          {{-- food menu --}}
            <div class="mb-6 ml-0 max-w-full mx-auto bg-white rounded-lg shadow-md p-6">
              <h2 class="text-2xl font-semibold mb-4">Food Menu</h2>
          
              <!-- Menu Categories as Columns -->
              <div class="grid grid-cols-3 gap-4">
                <!-- Dinner Category -->
                <div class="bg-blue-100 rounded-lg p-4">
                  <h3 class="text-lg font-semibold mb-2">Dinner</h3>
                  <ul>
                    <li class="mb-2">Dish 1 - $10.99</li>
                    <li class="mb-2">Dish 2 - $12.99</li>
                    <!-- Add more dinner items as needed -->
                  </ul>
                </div>
          
                <!-- Snacks Category -->
                <div class="bg-green-100 rounded-lg p-4">
                  <h3 class="text-lg font-semibold mb-2">Snacks</h3>
                  <ul>
                    <li class="mb-2">Snack 1 - $4.99</li>
                    <li class="mb-2">Snack 2 - $6.99</li>
                    <!-- Add more snack items as needed -->
                  </ul>
                </div>
          
                <!-- Dessert Category -->
                <div class="bg-red-100 rounded-lg p-4">
                  <h3 class="text-lg font-semibold mb-2">Dessert</h3>
                  <ul>
                    <li class="mb-2">Dessert 1 - $7.99</li>
                    <li class="mb-2">Dessert 2 - $8.99</li>
                    <!-- Add more dessert items as needed -->
                  </ul>
                </div>
              </div>
            </div>
          
          
    
        <!-- Capacity Section -->
        <div class="mb-6 ml-0 max-w-full mx-auto bg-white rounded-lg shadow-md p-6">
          <h3 class="text-2xl font-semibold mb-4">Capacity</h3>
          <ul>
            <li>Banquet Capacity - {{$data->banquet_capacity}}</li>
            <li>Two-Wheeler Capacity - {{$data->twowheeler}}</li>
            <li>Four-Wheeler Capacity - {{$data->fourwheeler}}</li>
          </ul>
        </div>


        <!-- Contact Information-->
          <div class="mb-6 ml-0 max-w-full mx-auto bg-white rounded-lg shadow-md p-6">
              <h3 class="text-2xl font-semibold mb-4">Contact Information</h3>
              <div class="mt-8">
                <span class="text-blue-600">
                  <i class="fas fa-envelope"></i>
                </span>
                <a href="mailto:{{$data->email}}" class="text-blue-600 hover:underline">{{$data->email}}</a>
              </div>

              <div class="mt-4">
                <span class="text-green-600">
                  <i class="fas fa-phone"></i>
                </span>
                <a href="tel:{{$data->contactNumber}}" class="text-blue-600 hover:underline">{{$data->contactNumber}}</a>
              </div>

              <div class="mt-4">
                <span class="text-red-600">
                  <i class="fas fa-map-marker-alt"></i>
                </span>
                <a href="{{$data->location}}" class="text-blue-600 hover:underline">{{$data->location}}</a>
              </div>
          </div>
      




      <div id="button" class="flex justify-between">
         <!-- Update Button -->
      <div class="text-center">
        <a href="create-record" class="ml-32 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
          Create Record
        </a>
      </div>

       <!--Delete Button -->
       <div class="text-center">
        <a href="delete-record" class="mr-32 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
          Delete Record
        </a>
        </div>
       </div>

      </div>
       
      
        {{-- <!-- Right Column - View Details -->
        
            <div class="mt-8 bg-white rounded shadow p-4">
                <h2 class="text-xl font-semibold mb-4">View Records</h2>
                <table class="min-w-full">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$data->banquetname}}</td>
                                <td>{{$data->email}}</td>
                            </tr>
                        </tbody>
                    </table>
            </div>     --}}


    
<div id="profile-dialog" class="fixed right-0 top-0 h-screen w-1/3 bg-white shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out overflow-y-auto">
    <!-- Content for the profile dialog box -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <!-- User Profile Header -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold">User Profile</h2>
            <button class="text-blue-500 hover:underline">Change Password</button>
        </div>
    
        <!-- Profile Information -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="font-semibold">Email:</label>
                <p class="text-gray-700">{{$data->email}}</p>
            </div>

            <div>
                <label class="font-semibold">Contact Number:</label>
                <p class="text-gray-700">123-456-7890</p>
            </div>
    
            <div>
                <label class="font-semibold">Banquet Name:</label>
                <p class="text-gray-700">{{$data->banquetname}}</p>
            </div>
    
            <div>
                <label class="font-semibold">Location:</label>
                <p class="text-gray-700">123 Main St, City, Country</p>
            </div>
        </div>
    </div>
    
    
    <!-- Close button -->
    <button id="close-dialog" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>


<script type="text/javascript">


function createRecord() {

}

// Function to read and display records
function readRecords() {

}


// Function to delete a record
function deleteRecord(recordId) {
    // Send a DELETE request to the server to delete the record
    // Remove the corresponding row from the table
}


//profile dialogue
document.addEventListener('DOMContentLoaded', function () {
    const profileLink = document.getElementById('profile-link');
    const profileDialog = document.getElementById('profile-dialog');
    const closeDialog = document.getElementById('close-dialog');

    // Open the profile dialog when the link is clicked
    profileLink.addEventListener('click', function (e) {
        e.preventDefault();
        profileDialog.classList.remove('translate-x-full');
    });

    // Close the profile dialog when the close button is clicked
    closeDialog.addEventListener('click', function () {
        profileDialog.classList.add('translate-x-full');
    });
});

</script>
</body>
</html>