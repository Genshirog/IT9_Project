<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="{{ asset('js/tailwind.js')}}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-center bg-no-repeat bg-[url('{{ asset('images/bg.jpg') }}')] bg-[length:100%_100%] h-screen">
    <div class="flex items-center justify-center min-h-screen relative overflow-hidden">
        <form id="loginForm" action="{{ route('login') }}" method="POST" class="absolute transition-all duration-500 ease-in-out transform bg-black/30 p-8 rounded shadow-md backdrop-blur-sm">
            @csrf
            <div class="mb-4 text-center text-2xl text-white">
                <h2>LOGIN</h2>
            </div>
            <div class="mb-4">
                <label for="username" class="text-white">Username:</label>
                <input type="text" name="username" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Username">
                @error('username','login')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="text-white">Password:</label>
                <input type="password" name="password" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Password">
                @error('password','login')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="w-[50%] bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600">Login</button>
            </div>
            <div class="text-center mt-4 text-white">
                <a href="#" class="text-white-500 hover:underline" onclick="showRegister()">Don't have an account?</a>
            </div>
        </form>
        <!--register-->
        <form id="registerForm" action="{{ route('store') }}" method="POST" class="absolute transition-all duration-500 ease-in-out transform translate-y-full opacity-0 bg-black/30 p-8 rounded shadow-md backdrop-blur-sm hidden">
            @csrf
            <div class="mb-4 text-center text-2xl text-white">
                <h2>REGISTER</h2>
            </div>
            <div class="flex space-x-8 mb-4">
                <div class="flex flex-col w-1/2">
                    <label for="firstname" class="text-white">Firstname:</label>
                    <input type="text" name="firstname" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Firstname">
                    @error('firstname','register')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col w-1/2">
                    <label for="lastname" class="text-white">Lastname:</label>
                    <input type="text" name="lastname" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Lastname">
                    @error('lastname','register')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="flex space-x-8 mb-4">
                <div class="flex flex-col w-1/2">
                    <label for="birthday" class="text-white">Birthday:</label>
                    <input type="text" name="birthday" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="yyyy-mm-dd">
                    @error('birthday','register')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col w-1/2">
                    <label for="email" class="text-white">Email:</label>
                    <input type="email" name="email" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Email  ">
                    @error('email','register')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mb-4">
                <label for="username" class="text-white">Username:</label>
                <input type="text" name="username" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Username">
                @error('username','register')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="text-white">Password:</label>
                <input type="password" name="password" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Password">
                @error('password','register')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="w-[50%] bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600">Sign Up</button>
            </div>
            <div class="text-center mt-4 text-white">
                <a href="#"onclick="showLogin()" >Already have an account?</a>
            </div>
        </form>
        <script>
            function showRegister() {
                const loginForm = document.getElementById('loginForm');
                const registerForm = document.getElementById('registerForm');

                // 1. Unhide register FIRST but set it invisible and down
                registerForm.classList.remove('hidden');
                registerForm.classList.add('translate-y-full', 'opacity-0');

                // 2. Force browser to notice it (important hack)
                setTimeout(() => {
                    // Move login down and fade
                    loginForm.classList.add('translate-y-full', 'opacity-0');
                    loginForm.classList.remove('translate-y-0', 'opacity-100');

                    // Move register up and appear
                    registerForm.classList.remove('translate-y-full', 'opacity-0');
                    registerForm.classList.add('translate-y-0', 'opacity-100');
                }, 20); // small timeout to trigger CSS

                // 3. After animation ends, hide login
                setTimeout(() => {
                    loginForm.classList.add('hidden');
                }, 500); // match transition duration
            }

            function showLogin() {
                const loginForm = document.getElementById('loginForm');
                const registerForm = document.getElementById('registerForm');

                loginForm.classList.remove('hidden');
                registerForm.classList.add('translate-y-0', 'opacity-100');

                setTimeout(() => {
                    // Move register down and fade
                    registerForm.classList.add('translate-y-full', 'opacity-0');
                    registerForm.classList.remove('translate-y-0', 'opacity-100');

                    // Move login up and appear
                    loginForm.classList.remove('translate-y-full', 'opacity-0');
                    loginForm.classList.add('translate-y-0', 'opacity-100');
                }, 20);

                setTimeout(() => {
                    registerForm.classList.add('hidden');
                }, 500);
            }
        </script>
    </div>
</body>
</html>