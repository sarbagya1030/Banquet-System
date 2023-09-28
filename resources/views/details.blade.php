<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <title>Detail</title>
</head>
 <body class="bg-gray-100">
    {{-- <table border="1">
        <tr>
            <th>ID</th>
            <th>banquetname</th>
            <th>registrationNumber</th>
            <th>location</th>
            <th>licenseNumber</th>
            <th>contactNumber</th>
            <th>capacity</th>
            <th>email</th>
            <th>images</th>
            <th>dates</th>
        </tr>
        @if (!@empty($details))
             @foreach ($details as $detail)
             <tr>
                <td>{{$detail->id}}</td>
                <td>{{$detail->banquetname}}</td>
                <td>{{$detail->registrationNumber}}</td>
                <td>{{$detail->location}}</td>
                <td>{{$detail->licenseNumber}}</td>
                <td>{{$detail->contactNumber}}</td>
                <td>{{$detail->capacity}}</td>
                <td>{{$detail->email}}</td>
                <td>{{$detail->image}}</td>
                <td>{{$detail->date}}</td>
            </tr>
             @endforeach
        @endif

    </table> --}}

            <!-- Main Content -->
            <div class="container mx-auto py-8">
                <div class="grid grid-rows-1 md:grid-rows-2 lg:grid-rows-4 gap-4">
                    @if (!@empty($details))
                    @foreach ($details as $detail)
                    <div class="bg-white rounded-lg p-4 shadow-md">
                        <h2 class="text-lg font-semibold mb-2">{{$detail->banquetname}}</h2>
                        <p>Registration Number: {{$detail->registrationNumber}}<br>
                           Location: {{$detail->location}}<br>
                           License Number:{{$detail->licenseNumber}}<br>
                           Contact Number: {{$detail->contactNumber}}<br>
                           Email:{{$detail->email}}<br>
                           Description: {{$detail->description}} <br>
                           Image: {{$detail->path}}<br>
                           Date: {{$detail->date}}<br>
                           Item: {{$detail->foodname}}<br>
                           type: {{$detail->type}}<br>
                           price: {{$detail->price}}<br>
                           capacity: {{$detail->banquet_capacity}} <br>
                           Parking : {{$detail->twowheeler}} for 2-wheeler<br>
                                     {{$detail->threewheeler}} for 4-wheeler<br>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            


    
</body>
</html>