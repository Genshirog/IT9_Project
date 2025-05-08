<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('icon')
    <script src="{{ asset('js/tailwind.js')}}"></script>
    <link href="{{ asset('font_awesome/css/all.min.css')}}" rel="stylesheet">
</head>
<body class="bg-[#094047]">
    <div class="flex">
        @include('staff.sidebar')
        <div class="flex-1 p-8 overflow-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex">
                        <h1 class="text-2xl font-bold mb-4 text-gray-800">Products Table</h1>
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
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr class="border-t border-gray-200">
                                <td class="py-4 px-6 break-words whitespace-normal">{{ $product->ProductID }}</td>
                                <td class="py-4 px-6 break-words whitespace-normal"><img src="{{ asset('storage/'.$product->image) }}" alt="" class="h-20 w-20 object-cover rounded-lg"></td>
                                <td class="py-4 px-6 break-words whitespace-normal">{{ $product->productName }}</td>
                                <td class="py-4 px-6 break-words whitespace-normal">{{ $product->category }}</td>
                                <td class="py-4 px-6 break-words whitespace-normal">{{ $product->productDescription }}</td>
                                <td class="py-4 px-6 break-words whitespace-normal">P{{ $product->price }}</td>
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
    @include('footer')
</body>
</html>