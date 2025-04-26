<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="{{ route('store') }}" method="POST">
        @csrf
        <input type="text" name="fname" id="">
        <input type="text" name="lname" id="">
        <input type="text" name="email" id="">
        <input type="text" name="username" id="">
        <input type="password" name="password" id="">
        <button type="submit">Register</button>
    </form>
    <a href="{{ route('auth') }}">Already have an account?</a>
</body>
</html>