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
    <h2 onclick="createRecord()" class="text-xl font-semibold mb-4" id="creation">Create Record</h2>
    <form id="createForm" class="space-y-2" >
        <!-- Input fields for creating a new record -->
        <div class="flex space-x-2" id="fcreate" style="display: none" >
            <div class="w-1/2">
                <label for="name" class="mt-4 block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" id="banquetname" name="name" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <label for="registration" class="mt-4 block text-sm font-medium text-gray-700">Registration Number:</label>
                <input type="text" id="registration" name="registrationNumber" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <label for="location" class="mt-4 block text-sm font-medium text-gray-700">Location:</label>
                <input type="text" id="location" name="location" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <label for="license" class="mt-4 block text-sm font-medium text-gray-700">License Number:</label>
                <input type="text" id="license" name="licenseNumber" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <label for="number" class="mt-4 block text-sm font-medium text-gray-700">Contact Number:</label>
                <input type="number" id="number" name="contactNumber" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <label for="dates" class="mt-4 block text-sm font-medium text-gray-700">Available Dates:</label>
                <input type="date" id="dates" name="dates" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <label for="capacity" class="mt-4 block text-sm font-medium text-gray-700">Capacity:</label>
                <input type="number" id="capacity" name="capacity" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <label for="email" class="mt-4 block text-sm font-medium text-gray-700">Email:</label>
                <input type="text" id="email" name="email" required
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        
            </div>

            <div class="max-w-2xl">
                <h1 class=" mt-4 block text-sm font-medium text-gray-700">Upload Images:</h1><br>
                <input type="file" id="imageInput" name="image[]" multiple class="hidden">
                <label for="imageInput" class="mt-1 px-4 py-2 bg-gray-500 text-white cursor-pointer rounded-lg">
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

<!-- JavaScript for CRUD operations -->
<script type="text/javascript">
// Define JavaScript functions to handle CRUD operations
// Use fetch or AJAX to communicate with a backend API
// Function to create a new record
function createRecord() {
    const form = document.querySelector("#fcreate");
    const create = document.querySelector("#creation");
form.style.display = "block"

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

</script>



   
</body>
</html>