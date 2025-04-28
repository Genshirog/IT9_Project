<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-center bg-no-repeat bg-[url('{{ asset('images/bg.jpg') }}')] bg-[length:100%_100%] h-screen">
    <div class="flex items-center justify-center min-h-screen">
        <form action="{{ route('store') }}" method="POST" class="bg-black/30 p-8 rounded shadow-md backdrop-blur-sm">
            @csrf
            <div class="mb-4 text-center text-2xl text-white">
                <h2>REGISTER</h2>
            </div>
            <div class="flex space-x-8 mb-4">
                <div class="flex flex-col w-1/2">
                    <label for="firstname" class="text-white">Firstname:</label>
                    <input type="text" name="firstname" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Firstname">
                </div>
                <div class="flex flex-col w-1/2">
                    <label for="lastname" class="text-white">Lastname:</label>
                    <input type="text" name="lastname" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Lastname">
                </div>
            </div>
            <div class="flex space-x-8 mb-4">
                <div class="flex flex-col w-1/2">
                    <label for="birthday" class="text-white">Birthday:</label>
                    <input type="text" name="birthday" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="yyyy-mm-dd">
                </div>
                <div class="flex flex-col w-1/2">
                    <label for="email" class="text-white">Email:</label>
                    <input type="email" name="email" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Email  ">
                </div>
            </div>
            <div class="mb-4">
                <label for="username" class="text-white">Username:</label>
                <input type="text" name="username" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Username">
            </div>
            <div class="mb-4">
                <label for="password" class="text-white">Password:</label>
                <input type="password" name="password" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Password">
            </div>
            <div class="text-center">
                <button type="submit" class="w-[50%] bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600">Login</button>
            </div>
            <div class="text-center mt-4 text-white">
                <a href="{{ route('auth') }}">Already have an account?</a>
            </div>
        </form>
    </div>
</body>
</html>