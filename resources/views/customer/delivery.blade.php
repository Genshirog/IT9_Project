<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/tailwind.js')}}"></script>
    <script src="{{ asset('js/alpine.min.js') }}" defer></script>
    <link href="{{ asset('font_awesome/css/all.min.css')}}" rel="stylesheet">
    <title>Document</title>
</head>
<body class="bg-[#fef8f8]">
    @include('customer.navbar')
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-7xl p-6" x-data="{ openModal: false }"> <!-- Alpine data for the modal state -->
            <div class="flex-1 p-8 overflow-auto">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="flex">
                            <h1 class="text-2xl font-bold mb-4 text-gray-800">Users Table</h1>
                        </div>
                        <div class="flex justify-end">
                            <form action="" method="POST" class="flex items-center mb-4">
                                @csrf
                                <label for="search" class="text-gray-700 font-medium mr-2">Search</label>
                                <input
                                    type="text"
                                    name="search"
                                    id="search"
                                    placeholder="Search..."
                                    class="p-1 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="overflow-x-auto max-w-full">
                        <table class="min-w-max w-full table-auto border border-gray-200 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Birthday</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Password</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="border-t border-gray-200">
                                    <td class="py-4 px-6 break-words whitespace-normal">{{ $user->UserID }}</td>
                                    <td class="py-4 px-6 break-words whitespace-normal">{{ $user->User }}</td>
                                    <td class="py-4 px-6 break-words whitespace-normal">{{ $user->roleName }}</td>
                                    <td class="py-4 px-6 break-words whitespace-normal">{{ $user->birthday }}</td>
                                    <td class="py-4 px-6 break-words whitespace-normal">{{ $user->email }}</td>
                                    <td class="py-4 px-6 break-words whitespace-normal">{{ $user->contactNumber }}</td>
                                    <td class="py-4 px-6 break-words whitespace-normal">{{ $user->address }}</td>
                                    <td class="py-4 px-6 break-words whitespace-normal">{{ $user->username }}</td>
                                    <td class="py-4 px-6 break-words whitespace-normal">{{ $user->password }}</td>
                                    <td class="py-4 px-6 break-words whitespace-normal">
                                        <button class="text-blue-500 hover:underline">Edit</button>
                                        <button class="text-red-500 hover:underline ml-2">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- More rows here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            @if ($OrderItems->isEmpty())
                <div class="p-4">
                        <p class="text-center text-gray-500">Your cart is empty.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>