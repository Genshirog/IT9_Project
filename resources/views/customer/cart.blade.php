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
<body class="bg-[#fef8f8]">
    @include('customer.navbar')
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-7xl p-6" x-data="{ openModal: false }"> <!-- Alpine data for the modal state -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($cartItems as $product)
                    <div class="bg-white rounded-lg shadow-lg flex flex-col items-center p-6 transform transition-transform duration-300 hover:scale-105">
                        <div class="flex items-center justify-center w-full">
                            <img src="{{ asset('storage/'. $product->image) }}" alt="Image of {{ $product->productName }}" class="h-32 w-32 object-cover rounded-lg">
                        </div>
                        <div class="text-center mt-4">
                            <h3 class="font-bold text-lg">{{ $product->productName }}</h3>
                            <p class="text-xs text-gray-500">{{ $product->productDescription }}</p>
                            <p class="text-xs font-semibold mt-2">₱ {{ $product->price }} / {{ $product->unit ?? 'srv' }}</p>
                        </div>
                        <!-- Quantity and Remove button -->
                        <div x-data="{ quantity: {{ $product->quantity }} }" class="p-4 flex flex-col items-center space-y-4">
                            <div class="flex items-center space-x-2">
                            <form action="{{ route('customer.quantity', $product->CartItemID) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="quantity" value="{{ max(1, $product->quantity - 1) }}">
                                <button type="submit" class="bg-gray-200 px-4 py-2 rounded-full border-2 border-black hover:bg-gray-300">-</button>
                            </form>

                                <div class="bg-white text-center py-1 px-8 rounded-lg flex items-center justify-center mx-4 shadow-lg">
                                    <p x-text="quantity" class="text-xl font-semibold"></p>
                                </div>
                            <form action="{{ route('customer.quantity', $product->CartItemID) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="quantity" value="{{ $product->quantity + 1 }}">
                                <button type="submit" class="bg-gray-200 px-4 py-2 rounded-full border-2 border-black hover:bg-gray-300">+</button>
                            </form>
                            </div>
                            <!-- Remove from Cart button -->
                            <form action="{{ route('customer.removeItem', $product->CartItemID) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600">Remove</button>
                            </form>
                        </div>
                    </div>
                    @empty
                        <div class="p-4 col-span-full">
                            <p class="text-center text-gray-500">Your cart is empty.</p>
                        </div>
                    @endforelse
            </div>
        </div>
    </div>
    @include('customer.payment')
    @include('footer')
</body>
</html>
