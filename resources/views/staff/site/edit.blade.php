<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        @include('staff.sidebar')
        <div class="flex-1 p-8 overflow-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex">
                        <h1 class="text-2xl font-bold mb-4 text-gray-800">Orders Table</h1>
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
                <div class="flex space-x-4 mb-4">
                    <button onclick="showTable('paymentTable')" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Payment Status</button>
                    <button onclick="showTable('orderTable')" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Order Status</button>
                </div>
                <div id="paymentTable" class="table-section">
                    <div class="overflow-x-auto max-w-full">
                        <table class="min-w-max w-full table-auto border border-gray-200 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Price</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unpay as $order)
                                <tr class="border-t border-gray-200">
                                    <td class="py-4 px-6 break-words whitespace-normal">{{ $order->PaymentID }}</td>
                                    <td class="py-4 px-6 break-words whitespace-normal">{{ $order->OrderID }}</td>
                                    <td class="py-4 px-6 break-words whitespace-normal">{{ $order->totalPrice }}</td>
                                    <td class="py-4 px-6 break-words whitespace-normal">{{ $order->status }}</td>
                                    <td class="py-4 px-6 break-words whitespace-normal">
                                        <form action="{{ route('staff.site.status',$order->OrderID) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="OrderID" value="{{ $order->OrderID }}">
                                            <input type="hidden" name="status" value="Paid">
                                            <input type="number" name="amountPayed" class="border rounded px-2 py-1 w-32" required placeholder="₱" min="0" step="0.01">
                                            <button type="submit" class="ml-2 bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Pay</button>
                                        </form>
                                        @error('amountPayed')
                                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('amountPayed') }}</p>
                                        @enderror
                                    </td>
                                </tr>
                                @endforeach
                                <!-- More rows here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="orderTable" class="table-section hidden">
                    <table class="min-w-max w-full table-auto border border-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Status</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr class="border-t border-gray-200">
                                <td class="py-4 px-6">{{ $order->OrderID }}</td>
                                <td class="py-4 px-6">
                                    <span class="px-2 py-1 rounded
                                        {{
                                            $order->orderStatus === 'Preparing' ? 'bg-yellow-100 text-yellow-800' :
                                            ($order->orderStatus === 'Serving' ? 'bg-blue-100 text-blue-800' :
                                            ($order->orderStatus === 'Delivered' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'))
                                        }}">
                                        {{ $order->orderStatus }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <form method="POST" action="{{ route('staff.site.updateStatus', $order->OrderID) }}">
                                        @csrf
                                        @method('PUT')
                                        <button
                                            class="bg-indigo-500 hover:bg-indigo-600 text-white text-xs px-3 py-1 rounded"
                                            type="submit">
                                            Next Status
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function showTable(tableId) {
        const sections = document.querySelectorAll('.table-section');
        sections.forEach(section => section.classList.add('hidden'));
        document.getElementById(tableId).classList.remove('hidden');
    }
</script>
</html>