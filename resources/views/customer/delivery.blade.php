<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/tailwind.js')}}"></script>
    <script src="{{ asset('js/alpine.min.js') }}" defer></script>
    <link href="{{ asset('font_awesome/css/all.min.css')}}" rel="stylesheet">
    @include('icon')
</head>
<body class="bg-[#fef8f8] min-h-screen flex flex-col">
    @include('customer.navbar')
    <div class="flex-grow flex items-center justify-center">
        <div class="w-full max-w-7xl px-4"> <!-- Removed p-6 -->
            @if($delivery->isNotEmpty())
            <div class="bg-white rounded-lg shadow p-4 h-full flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold text-gray-800">Order Status Table</h1>
                </div>
                <div class="overflow-auto flex-grow">
                    <table class="min-w-full table-auto border border-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">OrderID</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Status</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Status</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($delivery as $order)
                            <tr class="border-t border-gray-200">
                                <td class="py-4 px-6 break-words">{{ $order->OrderID }}</td>
                                <td class="py-4 px-6 break-words">{{ $order->orderStatus }}</td>
                                <td class="py-4 px-6 break-words">{{ $order->paymentStatus }}</td>
                                <td class="py-4 px-6 break-words">{{ $order->totalPrice }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $delivery->links() }}
                    </div>
                </div>
            </div>
            @else
                <div class="p-4 col-span-full">
                    <p class="text-center text-gray-500">Your delivery is empty.</p>
                </div>
            @endif
        </div>
    </div>
    @include('footer')
</body>
</html>