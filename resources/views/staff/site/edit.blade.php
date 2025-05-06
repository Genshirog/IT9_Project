<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-[#094047]">
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
                            @foreach ($orders as $order)
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
        </div>
    </div>
</body>
</html>