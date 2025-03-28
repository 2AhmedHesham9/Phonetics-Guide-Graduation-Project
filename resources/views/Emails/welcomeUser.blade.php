<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Hi {{ $user->first_name. " ". $user->last_name }}</h1>

    <p>
        Thank you for registering on our application. We hope you a great day
    </p>
    <p>If You have any questions ,please feel free to contact us. </p>
    <p>Best regardes,<br>{{ env('APP_NAME') }}</p>
</body>

</html>