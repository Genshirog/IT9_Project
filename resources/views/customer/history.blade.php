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
<body class="bg-[#fef8f8] min-h-screen flex flex-col">
    @include('customer.navbar')
    <div class="flex-grow flex items-center justify-center">
        <div class="w-full max-w-7xl px-4"> <!-- Removed p-6 -->
            @if($payments->isNotEmpty())
            <div class="bg-white rounded-lg shadow p-4 h-full flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold text-gray-800">Order Status Table</h1>
                </div>
                <div class="overflow-auto flex-grow">
                    <table class="min-w-full table-auto border border-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Method</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount Paid</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount Changed</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Price</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Delivery Type</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Status</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                            <tr class="border-t border-gray-200">
                                <td class="py-4 px-6 break-words">{{ $payment->PaymentID }}</td>
                                <td class="py-4 px-6 break-words">{{ $payment->OrderID }}</td>
                                <td class="py-4 px-6 break-words">{{ $payment->paymentMethod }}</td>
                                <td class="py-4 px-6 break-words">{{ $payment->amountPayed }}</td>
                                <td class="py-4 px-6 break-words">{{ $payment->amountChanged }}</td>
                                <td class="py-4 px-6 break-words">{{ $payment->totalPrice }}</td>
                                <td class="py-4 px-6 break-words">{{ $payment->deliveryType }}</td>
                                <td class="py-4 px-6 break-words">{{ $payment->paymentStatus }}</td>
                                <td class="py-4 px-6 break-words">{{ $payment->orderDate }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
            @else
                <div class="p-4 col-span-full">
                    <p class="text-center text-gray-500">Your Payment is empty.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>