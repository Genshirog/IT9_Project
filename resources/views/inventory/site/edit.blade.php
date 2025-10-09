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
@if(session('error') || session('success'))
    <div id="alert-box" class="fixed top-0 left-1/2 transform -translate-x-1/2 w-full sm:w-1/2 z-50">
        <div class="alert-box 
                    {{ session('error') ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }} 
                    p-4 rounded-lg shadow-lg flex items-center justify-between transition-opacity opacity-100 duration-200 ease-in-out">
            <div class="flex items-center">
                <span class="font-semibold">
                    {{ session('error') ?? session('success') }}
                </span>
            </div>
            <button id="close-alert" class="text-white ml-4">&times;</button>
        </div>
    </div>

    <script>
        // Automatically hide the alert after 3 seconds
        setTimeout(function() {
            let alertBox = document.getElementById('alert-box');
            alertBox.classList.add('opacity-0');
            alertBox.classList.add('transition-opacity');
            alertBox.classList.add('duration-500');

            // Hide alert completely after fade-out
            setTimeout(function() {
                alertBox.style.display = 'none';
            }, 500); // Match duration of the fade-out effect
        }, 1500); // 3 seconds delay before fading out

        // Optionally, you can add close button functionality
        document.getElementById('close-alert').addEventListener('click', function() {
            let alertBox = document.getElementById('alert-box');
            alertBox.classList.add('opacity-0');
            alertBox.classList.add('transition-opacity');
            alertBox.classList.add('duration-500');
            
            setTimeout(function() {
                alertBox.style.display = 'none';
            }, 500); // Match duration of the fade-out effect
        });
    </script>
@endif
    <div class="flex">
        @include('inventory.sidebar')
        <div class="flex-1 p-8 overflow-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="grid grid-cols-2 gap-6 mb-4">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-gray-800">Inventory Table</h1>
                    </div>

                    <div class="flex items-center justify-end space-x-2">
                        <!-- Search -->
                        <form action="{{ route('inventory.site.search') }}" method="GET" class="flex items-center">
                            @csrf
                            <label for="search" class="text-gray-700 font-medium mr-2">Search</label>
                            <input
                                type="text"
                                name="productName"
                                id="search"
                                placeholder="Search..."
                                class="p-1 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                            <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 ml-2">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>

                        <!-- Export CSV -->
                        <!-- Export CSV -->
                        <a href="{{ route('inventory.site.exportCSV') }}" class="bg-green-500 text-white p-2 rounded hover:bg-green-600">
                            <i class="fas fa-file-csv"></i> Export CSV
                        </a>


                        <!-- Notify Staff -->
                        <button id="notifyStaffBtn" type="button" class="bg-yellow-500 text-white p-2 rounded hover:bg-yellow-600">
                            <i class="fas fa-bell"></i> Notify Staff
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto max-w-full">
                    <table id="statusTable" class="min-w-max w-full table-auto border border-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inventory ID</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Image</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacity</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventoryTable as $inventory)
                            <tr class="border-t border-gray-200">
                                <td class="py-4 px-6 break-words whitespace-normal">{{ $inventory->InventoryID }}</td>
                                <td class="py-4 px-6 break-words whitespace-normal"><img src="{{ asset('storage/'.$inventory->image) }}" alt="" class="h-20 w-20 object-cover rounded-lg"></td>
                                <td class="py-4 px-6 break-words whitespace-normal">{{ $inventory->productName }}</td>
                                <td class="py-4 px-6 break-words whitespace-normal">{{ $inventory->category }}</td>
                                <td class="py-4 px-6 break-words whitespace-normal">{{ $inventory->capacity }}</td>
                                <td class="py-4 px-6 break-words whitespace-normal">{{ $inventory->quantity }}</td>
                                <td class="py-4 px-6 break-words whitespace-normal">{{ $inventory->status }}</td>
                                <td class="py-4 px-6 break-words whitespace-normal">{{ $inventory->lastUpdated }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('footer')
    <script>
document.getElementById('notifyStaffBtn').addEventListener('click', function () {
    
    // Create alert box
    let alertBox = document.createElement('div');
    alertBox.className = 'fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white p-4 rounded-lg shadow-lg z-50 transition-opacity duration-500 opacity-100';
    alertBox.innerText = '✅ Staff has been notified!';

    // Add to page
    document.body.appendChild(alertBox);

    // Fade out after 2 seconds
    setTimeout(() => {
        alertBox.style.opacity = '0';
        setTimeout(() => alertBox.remove(), 500); // Remove completely
    }, 2000);
});
</script>
</body>
</html>