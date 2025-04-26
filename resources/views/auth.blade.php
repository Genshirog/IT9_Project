<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <input type="text" name="username" id="">
        <input type="password" name="password" id="">
        <button type="submit">Login</button>
    </form>
    <a href="{{ route('register') }}">Dont have an account?</a>
</body>
</html>