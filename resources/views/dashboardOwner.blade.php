<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <title>Dashboard_Owner</title>
</head>
<body>
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

    <div class="flex justify-center">
        <!-- Left Column - Form -->
        <div class="w-1/2 p-4">
            <div class="mt-8 p-4 bg-white rounded shadow">
                <h1 onclick="createRecord()" class="text-2xl font-semibold mb-6 cursor-pointer" id="creation">Create & Update Record</h1>
               
                    <!-- Input fields for creating a new record -->
                    <div class="flex space-x-2" id="fcreate" style="display: none" >

                            {{-- //food menu --}}
                            <div class="max-w-2xl mx-auto mt-8 p-6 bg-white shadow-md rounded-md">
                                <h2  class="text-xl font-semibold mb-4 cursor-pointer">Insert Food Menu</h2>
                                <form id="menu" action="{{route('menu',Session::get('loginEmail'))}}" method="POST">
                                  @if(Session::has('success'))
                                  <div role="alert" class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3">{{Session::get('success')}}</div>
                                  @endif
                                  @if(Session::has('fail'))
                                  <div role="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">{{Session::get('fail')}}</div>
                                  @endif
                                  @csrf

                                  <div class="mb-4">
                                    <label for="item_name" class="block text-gray-700 font-semibold mb-2">Item Name:</label>
                                    <input type="text" id="item_name" name="item_name" class="border rounded-md px-3 py-2 w-full" required>
                                    <span class=" text-red-600">@error('item_name') {{$message}} @enderror</span>
                                  </div>
                              
                                  <div class="mb-4">
                                    <label for="type" class="block text-gray-700 font-semibold mb-2">Type:</label>
                                    <input type="radio" id="snacks" name="type">
                                    <label for="type" class="mr-8">Snacks</label>
                                    <input type="radio" id="dinner" name="type">
                                    <label for="type" class="mr-8">Dinner</label>
                                    <input type="radio" id="desert" name="type">
                                    <label for="type" class="mr-8">Desert</label>
                                    <span class=" text-red-600">@error('type') {{$message}} @enderror</span>
                                  </div>
                              
                                  <div class="mb-4">
                                    <label for="price" class="block text-gray-700 font-semibold mb-2">Price:</label>
                                    <input type="number" id="price" name="price" class="border rounded-md px-3 py-2 w-full" step="0.01" required>
                                    <span class=" text-red-600">@error('price') {{$message}} @enderror</span>
                                  </div>
                              
                              
                                  <div class="mt-6">
                                    <button type="submit" class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Items</button>
                                  </div>
                                </form>
                              </div>


                            {{-- //available-dates --}}
                              <div class="max-w-2xl mx-auto mt-8 p-6 bg-white shadow-md rounded-md">
                                <h2 class="text-xl font-semibold mb-4 cursor-pointer">Insert Available Dates</h2>
                                <form id="dates" method="POST"" action="">
                                  @csrf
                              
                                  <div class="mb-4">
                                    <label for="dates" class="block text-gray-700 font-semibold mb-2">Available Dates:</label>
                                    <div id="dateInputs">
                                        <div class="flex items-center mt-1">
                                            <input type="date" id="dates" name="date[]" required class=" focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            <button class="bg-blue-400 hover:bg-blue-600 text-white px-4 py-2 rounded ml-2" type="button" onclick="addDateInput()">Add</button>
                                        </div>
                                    </div>
                                  </div>
    
                              
                                  <div class="mt-6">
                                    <button type="submit" class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Dates</button>
                                  </div>
                                </form>
                              </div>

                                
                        
                              {{-- multiple images --}}
                              <div class="max-w-2xl mx-auto mt-8 p-6 bg-white shadow-md rounded-md">
                                <h2 class="text-xl font-semibold mb-4 cursor-pointer">Upload Images</h2>
                                <form id="images" action="" method="POST">
                                  @csrf
                              
                                  <div class="mb-4">
                                    <label for="images" class="block text-gray-700 font-semibold mb-2">Select Images:</label>
                                    <input type="file" id="images" name="images[]" class="border rounded-md px-3 py-2 w-full" multiple required>
                                  </div>
                              
                                  <div class="mt-6">
                                    <button type="submit" class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Images</button>
                                  </div>
                                </form>
                              </div>


                              {{-- //capacity --}}
                              <div class="max-w-2xl mx-auto mt-8 p-6 bg-white shadow-md rounded-md">
                                <h2 class="text-xl font-semibold mb-4 cursor-pointer">Banquet Capacity</h2>
                              
                                <form id="capacity" method="POST" action="">
                                  @csrf
                              
                                  <div class="mb-4">
                                    <label for="banquet_capacity" class="block text-gray-700 font-semibold mb-2">Banquet Capacity:</label>
                                    <input type="number" id="banquet_capacity" name="banquet_capacity" class="border rounded-md px-3 py-2 w-full" required>
                                    <span class=" text-red-600">@error('banquet_capacity') {{$message}} @enderror</span>
                                  </div>
                              
                                  <div class="mb-4">
                                    <label for="two_wheeler_capacity" class="block text-gray-700 font-semibold mb-2">Two-Wheeler Capacity:</label>
                                    <input type="number" id="two_wheeler_capacity" name="two_wheeler_capacity" class="border rounded-md px-3 py-2 w-full" required>
                                    <span class=" text-red-600">@error('two_wheeler_capacity') {{$message}} @enderror</span>
                                  </div>
                              
                                  <div class="mb-4">
                                    <label for="four_wheeler_capacity" class="block text-gray-700 font-semibold mb-2">Four-Wheeler Capacity:</label>
                                    <input type="number" id="four_wheeler_capacity" name="four_wheeler_capacity" class="border rounded-md px-3 py-2 w-full" required>
                                    <span class=" text-red-600">@error('four_wheeler_capacity') {{$message}} @enderror</span>
                                  </div>
                              
                                  <div class="mt-6">
                                    <button type="submit" class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Capacity</button>
                                  </div>
                                </form>
                              </div>
                              

                        
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
    const form = document.querySelector("#fcreate");
    const create = document.querySelector("#creation");
    form.style.display = "block"; 
//     toggleForm.addEventListener('click', () => {
//     myForm.classList.toggle('hidden');
// });
}

// Function to read and display records
function readRecords() {
    // Send a GET request to the server to retrieve records
    // Populate the recordList table with the retrieved data
}


// Function to delete a record
function deleteRecord(recordId) {
    // Send a DELETE request to the server to delete the record
    // Remove the corresponding row from the table
}

// Add event listeners to call CRUD functions on form submissions, button clicks, etc.

// Initialize the UI by calling readRecords() on page load





// JavaScript to add more date inputs
function addDateInput() {
const dateInputs = document.getElementById('dateInputs');
const newDateInput = document.createElement('div');
newDateInput.className = 'flex items-center mb-2';
newDateInput.innerHTML = `
    <input class=" focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="date" name="date[]" required>
    <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded ml-2 mt-2" type="button" onclick="removeDateInput(this)">Remove</button>
`;
dateInputs.appendChild(newDateInput);
}

// JavaScript to remove a date input
function removeDateInput(button) {
const dateInputs = document.getElementById('dateInputs');
dateInputs.removeChild(button.parentNode);
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