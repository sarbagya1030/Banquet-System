@php
    use App\Models\dates;
    use App\Models\User;
    use App\Models\orders;
    $order = orders::where('id', $id)->first();
    $user = User::where('id', $order->fk_user_id)->first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking Display</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table role="presentation" cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td style="padding: 20px 0; text-align: center;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="150" height="150"
                    style="display: block; margin: 0 auto;">
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff; padding: 20px;">
                <h2 style="color: #333; font-size: 24px; margin: 0;">Booking Request</h2>
                <p style="color: #666; font-size: 16px; margin: 20px 0;">You have a booking from
                    {{ $user->firstname . ' ' . $user->lastname }}.<br> Date: {{ $order->orderedDate }}<br>
                    Total Number of guests: {{ $order->guestsNumber }}
                </p>
                {{-- <div style="text-align: center;">
                    <a href="#"
                        style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; font-size: 16px; border-radius: 5px;">Reset
                        Password</a>
                </div> --}}
                {{-- <p style="color: #666; font-size: 16px; margin: 20px 0;">If you did not request this password reset,
                    please ignore this email.</p> --}}
            </td>
        </tr>
        <tr>
            <td style="background-color: #333; padding: 20px; text-align: center; color: #fff; font-size: 14px;">
                &copy; 2023 Banquet Reservation System. All rights reserved.
            </td>
        </tr>
    </table>
</body>



</html>
