<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-[#094047]">
    <div class="flex">
        {{-- Sidebar --}}
        @include('admin.sidebar')

        {{-- Admin Profile Content --}}
        <div class="flex-1 p-8">
            <h1 class="text-3xl font-bold mb-6">Admin Profile</h1>
            <img src="" alt="insert image" class="w-32 h-32 object-cover rounded-full mb-6">

            <form action="" method="POST" enctype="multipart/form-data" class="mb-6">
                @csrf
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 uppercase rounded hover:bg-blue-600">Upload a photo</button>
            </form>

            <h2 class="text-2xl font-semibold mb-4">Account Information</h2>

            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <h4 class="font-semibold uppercase w-40">First Name:</h4>
                    <div class="bg-[#000220] p-3">
                        <p>{{ $user->firstname }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <h4 class="font-semibold uppercase w-40">Last Name:</h4>
                    <div class="bg-[#000220] p-3">
                        <p>{{ $user->lastname }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <h4 class="font-semibold uppercase w-40">Email:</h4>
                    <div class="bg-[#000220] p-3">
                        <p>{{ $user->email }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <h4 class="font-semibold uppercase w-40">Address:</h4>
                    <div class="bg-[#000220] p-3">
                        <p>{{ $user->address }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <h4 class="font-semibold uppercase w-40">Contact Number:</h4>
                    <div class="bg-[#000220] p-3">
                        <p>{{ $user->contactNumber }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <h4 class="font-semibold uppercase w-40">Username:</h4>
                    <div class="bg-[#000220] p-3">
                        <p>{{ $user->username }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <form action="#" method="POST" enctype="multipart/form-data" class="mb-6">
                    @csrf
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 uppercase rounded hover:bg-blue-600">Change Password</button>
                    </form>

                    <form action="#" method="POST" enctype="multipart/form-data" class="mb-6">
                    @csrf
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 uppercase rounded hover:bg-blue-600">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>