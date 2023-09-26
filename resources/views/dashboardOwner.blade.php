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
                <li><a href="logout" class="hover:underline">Logout</a></li>
                <li><a href="#" class="hover:underline">Profile</a></li>
            </ul>
        </div>
    </div>



<!-- Create Form -->
<div class="mt-4 p-4 bg-white rounded shadow">
    <h2 onclick="createRecord()" class="text-xl font-semibold mb-4 cursor-pointer" id="creation">Create Record</h2>
    <form id="createForm" method="POST" class="space-y-2" enctype="multipart/form-data" >
        @if(Session::has('success'))
              <div role="alert" class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3">{{Session::get('success')}}</div>
              @endif
              @if(Session::has('fail'))
              <div role="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">{{Session::get('fail')}}</div>
              @endif
            @csrf
            @method('PUT')
        <!-- Input fields for creating a new record -->
        <div class="flex space-x-2" id="fcreate" style="display: none" >
            <div class="w-1/2">
                <div>
                <label for="name" class="mt-4 block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" id="banquetname" name="banquetname" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$data->banquetname}}">
                <span class=" text-red-600">@error('banquetname') {{$message}} @enderror</span>
                </div>
                
                <div>
                <label for="registration" class="mt-4 block text-sm font-medium text-gray-700">Registration Number:</label>
                <input type="text" id="registration" name="registrationNumber" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$data->registrationNumber}}"> 
                <span class=" text-red-600">@error('registrationNumber') {{$message}} @enderror</span>
                </div>

                <div>
                <label for="location" class="mt-4 block text-sm font-medium text-gray-700">Location:</label>
                <input type="text" id="location" name="location" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$data->location}}">
                <span class=" text-red-600">@error('location') {{$message}} @enderror</span>
                </div>
                
                <div>
                <label for="license" class="mt-4 block text-sm font-medium text-gray-700">License Number:</label>
                <input type="text" id="license" name="licenseNumber" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$data->licenseNumber}}">
                <span class=" text-red-600">@error('licenseNumber') {{$message}} @enderror</span>
                </div>

                <div>
                <label for="number" class="mt-4 block text-sm font-medium text-gray-700">Contact Number:</label>
                <input type="number" id="number" name="contactNumber" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$data->contactNumber}}">
                <span class=" text-red-600">@error('contactNumber') {{$message}} @enderror</span>
                </div>

                <div>
                    <label for="dates" class="mt-4 block text-sm font-medium text-gray-700">Available Dates:</label>
                        <div id="dateInputs">
                            <div class="flex items-center mt-1">
                                <input type="date" id="dates" name="date[]" required class=" focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <button class="bg-blue-400 hover:bg-blue-600 text-white px-4 py-2 rounded ml-2" type="button" onclick="addDateInput()">Add</button>
                            </div>
                        </div>
                </div>
              
                <div>
                <label for="capacity" class="mt-4 block text-sm font-medium text-gray-700">Capacity:</label>
                <input type="number" id="capacity" name="capacity" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <span class=" text-red-600">@error('capacity') {{$message}} @enderror</span>
                </div>
                
                <div>
                <label for="email" class="mt-4 block text-sm font-medium text-gray-700">Email:</label>
                <input type="text" id="email" name="email" required
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$data->email}}">
                <span class=" text-red-600">@error('email') {{$message}} @enderror</span>
                </div>
            </div>

                <div>
                <h1 class="mt-4 block text-sm font-medium text-gray-700">Upload Images:</h1><br>
                <input type="file" id="imageInput" name="image[]" multiple class="hidden">
                <label for="imageInput" class="mt-1 px-2 py-2 bg-blue-400 hover:bg-blue-600 text-white cursor-pointer rounded-lg">
                    Select Images
                </label>
                <div id="imagePreview" class="mt-4 flex flex-wrap">
                    <!-- Preview images will be displayed here -->
                </div>
                </div>
            
        </div>

        <div class="mt-4">
            <button id="button"
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create
            </button>
        </div>
    </form>
</div>

<!-- Read Table -->
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
</div>

<!-- Update Form -->
<div class="mt-8 p-4 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Update Record</h2>
    <form id="updateForm" class="space-y-2">
        <!-- Input fields for updating an existing record -->
        <div class="flex space-x-2">
            <div class="w-1/2">
                <label for="updateName" class="block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" id="updateName" name="updateName" required
                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <!-- Add more input fields for other information -->
            <input type="hidden" id="recordId" name="recordId">
        </div>
        <div class="mt-4">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Update
            </button>
        </div>
    </form>
</div>
</div>


<script type="text/javascript">
// Define JavaScript functions to handle CRUD operations
// Use fetch or AJAX to communicate with a backend API
// Function to create a new record
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

// Function to update an existing record
function updateRecord() {
    // Retrieve data from the updateForm
    // Send a PUT request to the server to update the record
    // Update the table with the updated record
}

// Function to delete a record
function deleteRecord(recordId) {
    // Send a DELETE request to the server to delete the record
    // Remove the corresponding row from the table
}

// Add event listeners to call CRUD functions on form submissions, button clicks, etc.

// Initialize the UI by calling readRecords() on page load



//file upload
// Function to handle file input change event
function handleFileInputChange(event) {
    const fileInput = event.target;
    const imagePreview = document.getElementById("imagePreview");

    // Clear the existing preview
    imagePreview.innerHTML = "";

    // Loop through selected files and display a preview for each
    for (let i = 0; i < fileInput.files.length; i++) {
        const file = fileInput.files[i];

        // Check if the selected file is an image
        if (file.type.startsWith("image/")) {
            const img = document.createElement("img");
            img.className = "w-32 h-32 object-cover m-2";
            img.src = URL.createObjectURL(file);
            imagePreview.appendChild(img);
        }
    }
}

// Add a change event listener to the file input
const imageInput = document.getElementById("imageInput");
imageInput.addEventListener("change", handleFileInputChange);



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

</script>
</body>
</html>