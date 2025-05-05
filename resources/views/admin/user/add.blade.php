<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <script src="{{ asset('js/tailwind.js')}}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-[#094047]">
    <div class="flex">
        @include('admin.sidebar')
        <div class="flex flex-1 items-center justify-center min-h-screen">
            <div class="w-full max-w-4xl px-6"> <!-- Wider form -->
                <form action="{{ route('admin.user.store') }}" method="POST" class="bg-black/30 p-10 rounded shadow-md backdrop-blur-sm space-y-6">
                    @csrf
                    <h1 class="text-center text-3xl font-bold mb-8 text-white">Add Staff</h1>
                    <div class="grid grid-cols-2 gap-6"> <!-- 2 columns -->
                        <div class="flex flex-col">
                            <label class="text-white mb-1">Firstname</label>
                            <input type="text" name="firstname" class="p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Firstname">
                        </div>
                        <div class="flex flex-col">
                            <label class="text-white mb-1">Lastname</label>
                            <input type="text" name="lastname" class="p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Lastname">
                        </div>
                        <div class="flex flex-col">
                            <label class="text-white mb-1">Birthday</label>
                            <input type="text" name="birthday" class="p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="YYYY/MM/DD">
                        </div>
                        <div class="flex flex-col">
                            <label class="text-white mb-1">Email</label>
                            <input type="email" name="email" class="p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Email">
                        </div>
                        <div class="flex flex-col">
                            <label class="text-white mb-1">Username</label>
                            <input type="text" name="username" class="p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Username">
                        </div>
                        <div class="flex flex-col">
                            <label class="text-white mb-1">Password</label>
                            <input type="password" name="password" class="p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Password">
                        </div>
                    </div>

                    <div class="flex justify-center pt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-12 rounded-full text-lg">
                            Add Staff
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>