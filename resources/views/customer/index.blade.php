<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/tailwind.js')}}"></script>
    <script src="{{ asset('js/alpine.min.js') }}" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="bg-[#fef8f8]">
    @include('customer.navbar')
    <div class="flex flex-col md:flex-row items-center bg-gradient-to-r from-red-100 via-red-50 to-white p-6">
        <div class="w-full md:w-3/5">
            <p class="text-lg text-gray-700 leading-relaxed">
                Indulge in the irresistible flavors of BBQ Lagao and Beef Pares, where smoky, tender grilled meats meet the rich, savory goodness of slow-cooked beef. Each bite delivers a perfect balance of sweet, smoky, and umami notes, bringing comfort and satisfaction to your senses. These Filipino classics promise to take your taste buds on an unforgettable journey, making every meal a celebration of flavor.
            </p>
        </div>
        <div class="w-full md:w-2/5">
            <img src="{{ asset('images/bg.jpg') }}" alt="BBQ Lagao and Beef Pares" class="w-full h-48 object-fill rounded-md">
        </div>
    </div>
    <div class="container mx-auto my-6">
        <h2 class="text-2xl font-bold mb-4">Recommended & TOP Dishes:</h2>
        
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-4">
        @foreach ($recommendations as $product)
            <div x-data="{ open: false }">
                <div @click="open = true" class="bg-white rounded-lg shadow flex h-24 cursor-pointer transform transition-transform duration-300 hover:scale-105">
                    <div class="p-4 flex-1">
                        <h3 class="font-bold text-sm">{{ $product->productName }}</h3>
                        <p class="text-xs text-gray-500">{{ $product->productDescription }}</p>
                        <p class="text-xs font-semibold mt-2">₱ {{ $product->price }} / {{ $product->unit ?? 'srv' }}</p>
                    </div>
                    <img src="{{ asset('storage/'. $product->image) }}" alt="Image of {{ $product->productName }}" class="h-20 w-20 object-cover rounded-lg m-2">
                </div>

                <!-- Modal -->
            <div x-show="open" @click.away="open = false" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <form action="{{ route('customer.storeToCart') }}" method="POST" class="bg-[#FFF3F3] p-6 rounded-lg shadow-lg max-w-sm w-full relative">
                @csrf
                    <input type="text" hidden name="ProductID" value="{{ $product->ProductID }}">
                    <div class="flex justify-end p-4">
                        <button type="button" @click="open = false" class="absolute top-2 right-2 bg-[#FFF3F3] text-black px-4 py-2 rounded hover:bg-red-600 hover:text-white">x</button>
                    </div>
                        <img src="{{ asset('storage/'. $product->image) }}" alt="Image of {{ $product->productName }}" class="w-full h-40 object-cover rounded-lg mb-4">
                        <h2 class="text-lg font-bold mb-2">{{ $product->productName }}</h2>
                        <p class="mt-2 font-semibold">₱ {{ $product->price }} / {{ $product->unit ?? 'srv' }}</p>
                        <p class="text-sm text-gray-600">{{ $product->productDescription }}</p>
                        <div x-data="{ quantity: 1 }" class="flex flex-col space-y-4 p-6">
                            <!-- Row: Quantity Controls -->
                            <div class="flex flex-row items-center justify-center space-x-2">
                                <button type="button" @click="quantity = Math.max(1, quantity - 1)" 
                                        class="bg-gray-200 px-3 py-1 rounded-full border-2 border-black hover:bg-gray-300">-</button>
                                
                                        <div class="bg-white text-center py-1 px-8 rounded-lg flex items-center justify-center mx-4 shadow-lg">
                                            <p x-text="quantity" class="text-xl font-semibold"></p>
                                        </div>
                                
                                <button type="button" @click="quantity++" 
                                        class="bg-gray-200 px-3 py-1 rounded-full border-2 border-black hover:bg-gray-300">+</button>
                                
                                <!-- Hidden input to submit -->
                                <input type="hidden" name="quantity" :value="quantity">
                            </div>

                            <!-- Row: Add to Cart Button -->
                            <div>
                                <button type="submit" class="bg-[#33FF33] text-white px-4 py-2 rounded-fullc1 w-full hover:bg-white hover:text-green-500 hover:outline-none hover:ring-2 hover:ring-green-500 hover:border-green-500">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container mx-auto my-6">
        <h1 class="text-2xl font-bold mb-4">Available Dishes:</h1>
        <h2 class="text-xl font-bold mb-4">Name of the Dish Selection</h2>
        
        
        @php
            $availableChunks = $available->chunk(3);
        @endphp
        
        @foreach ($availableChunks as $chunk)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                @foreach ($chunk as $product)
                        <div x-data="{ open: false }">
                            <div @click="open = true" class="bg-white rounded-lg shadow flex h-24 cursor-pointer transform transition-transform duration-300 hover:scale-105">
                                <div class="p-4 flex-1">
                                    <h3 class="font-bold text-sm">{{ $product->productName }}</h3>
                                    <p class="text-xs text-gray-500">{{ $product->productDescription }}</p>
                                    <p class="text-xs font-semibold mt-2">₱ {{ $product->price }} / {{ $product->unit ?? 'srv' }}</p>
                                </div>
                                <img src="{{ asset('storage/'. $product->image) }}" alt="Image of {{ $product->productName }}" class="h-20 w-20 object-cover rounded-lg m-2">
                            </div>

                            <!-- Modal -->
                            <div x-show="open" @click.away="open = false" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <form action="{{ route('customer.storeToCart') }}" method="POST" class="bg-[#FFF3F3] p-6 rounded-lg shadow-lg max-w-sm w-full relative">
                                @csrf
                                    <input type="text" hidden name="ProductID" value="{{ $product->ProductID }}">
                                    <div class="flex justify-end p-4">
                                        <button type="button" @click="open = false" class="absolute top-2 right-2 bg-[#FFF3F3] text-black px-4 py-2 rounded hover:bg-red-600 hover:text-white">x</button>
                                    </div>
                                    <img src="{{ asset('storage/'. $product->image) }}" alt="Image of {{ $product->productName }}" class="w-full h-40 object-cover rounded-lg mb-4">
                                    <h2 class="text-lg font-bold mb-2">{{ $product->productName }}</h2>
                                    <p class="mt-2 font-semibold">₱ {{ $product->price }} / {{ $product->unit ?? 'srv' }}</p>
                                    <p class="text-sm text-gray-600">{{ $product->productDescription }}</p>
                                    <div x-data="{ quantity: 1 }" class="flex flex-col space-y-4 p-6">
                                        <!-- Row: Quantity Controls -->
                                        <div class="flex flex-row items-center justify-center space-x-2">
                                            <button type="button" @click="quantity = Math.max(1, quantity - 1)" 
                                                    class="bg-gray-200 px-3 py-1 rounded-full border-2 border-black hover:bg-gray-300">-</button>
                                            
                                                <div class="bg-white text-center py-1 px-8 rounded-lg flex items-center justify-center mx-4 shadow-lg">
                                                    <p x-text="quantity" class="text-xl font-semibold"></p>
                                                </div>
                                            
                                            <button type="button" @click="quantity++" 
                                                    class="bg-gray-200 px-3 py-1 rounded-full border-2 border-black hover:bg-gray-300">+</button>
                                            
                                            <!-- Hidden input to submit -->
                                            <input type="hidden" name="quantity" :value="quantity">
                                        </div>

                                        <!-- Row: Add to Cart Button -->
                                        <div>
                                            <button type="submit" class="bg-[#33FF33] text-white px-4 py-2 rounded-fullc1 w-full hover:bg-white hover:text-green-500 hover:outline-none hover:ring-2 hover:ring-green-500 hover:border-green-500">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                @endforeach
            </div>
        @endforeach


    <div class="container mx-auto my-6">
        <h2 class="text-xl font-bold mb-4">Roasted Dishes</h2>
        
        @php
            $Availroasted = $roasted->chunk(3);
        @endphp

        @foreach ($Availroasted as $chunk)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                @foreach ($chunk as $product)
                        <div x-data="{ open: false }">
                            <div @click="open = true" class="bg-white rounded-lg shadow flex h-24 cursor-pointer transform transition-transform duration-300 hover:scale-105">
                                <div class="p-4 flex-1">
                                    <h3 class="font-bold text-sm">{{ $product->productName }}</h3>
                                    <p class="text-xs text-gray-500">{{ $product->productDescription }}</p>
                                    <p class="text-xs font-semibold mt-2">₱ {{ $product->price }} / {{ $product->unit ?? 'srv' }}</p>
                                </div>
                                <img src="{{ asset('storage/'. $product->image) }}" alt="Image of {{ $product->productName }}" class="h-20 w-20 object-cover rounded-lg m-2">
                            </div>

                            <!-- Modal -->
                            <div x-show="open" @click.away="open = false" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <form action="{{ route('customer.storeToCart') }}" method="POST" class="bg-[#FFF3F3] p-6 rounded-lg shadow-lg max-w-sm w-full relative">
                                @csrf
                                    <input type="text" hidden name="ProductID" value="{{ $product->ProductID }}">
                                    <div class="flex justify-end p-4">
                                        <button type="button" @click="open = false" class="absolute top-2 right-2 bg-[#FFF3F3] text-black px-4 py-2 rounded hover:bg-red-600 hover:text-white">x</button>
                                    </div>
                                    <img src="{{ asset('storage/'. $product->image) }}" alt="Image of {{ $product->productName }}" class="w-full h-40 object-cover rounded-lg mb-4">
                                    <h2 class="text-lg font-bold mb-2">{{ $product->productName }}</h2>
                                    <p class="mt-2 font-semibold">₱ {{ $product->price }} / {{ $product->unit ?? 'srv' }}</p>
                                    <p class="text-sm text-gray-600">{{ $product->productDescription }}</p>
                                    <div x-data="{ quantity: 1 }" class="flex flex-col space-y-4 p-6">
                                        <!-- Row: Quantity Controls -->
                                        <div class="flex flex-row items-center justify-center space-x-2">
                                            <button type="button" @click="quantity = Math.max(1, quantity - 1)" 
                                                    class="bg-gray-200 px-3 py-1 rounded-full border-2 border-black hover:bg-gray-300">-</button>
                                            
                                                <div class="bg-white text-center py-1 px-8 rounded-lg flex items-center justify-center mx-4 shadow-lg">
                                                    <p x-text="quantity" class="text-xl font-semibold"></p>
                                                </div>
                                            
                                            <button type="button" @click="quantity++" 
                                                    class="bg-gray-200 px-3 py-1 rounded-full border-2 border-black hover:bg-gray-300">+</button>
                                            
                                            <!-- Hidden input to submit -->
                                            <input type="hidden" name="quantity" :value="quantity">
                                        </div>

                                        <!-- Row: Add to Cart Button -->
                                        <div>
                                            <button type="submit" class="bg-[#33FF33] text-white px-4 py-2 rounded-fullc1 w-full hover:bg-white hover:text-green-500 hover:outline-none hover:ring-2 hover:ring-green-500 hover:border-green-500">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                @endforeach
            </div>
        @endforeach
    </div>

        @php
            $AvailExtra = $extra->chunk(3);
        @endphp

    <div class="container mx-auto my-6">
        <h2 class="text-xl font-bold mb-4">Add-ons & Specials</h2>
        @foreach ($AvailExtra as $chunk)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                @foreach ($chunk as $product)
                        <div x-data="{ open: false }">
                            <div @click="open = true" class="bg-white rounded-lg shadow flex h-24 cursor-pointer transform transition-transform duration-300 hover:scale-105">
                                <div class="p-4 flex-1">
                                    <h3 class="font-bold text-sm">{{ $product->productName }}</h3>
                                    <p class="text-xs text-gray-500">{{ $product->productDescription }}</p>
                                    <p class="text-xs font-semibold mt-2">₱ {{ $product->price }} / {{ $product->unit ?? 'srv' }}</p>
                                </div>
                                <img src="{{ asset('storage/'. $product->image) }}" alt="Image of {{ $product->productName }}" class="h-20 w-20 object-cover rounded-lg m-2">
                            </div>

                            <!-- Modal -->
                            <div x-show="open" @click.away="open = false" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <form action="{{ route('customer.storeToCart') }}" method="POST" class="bg-[#FFF3F3] p-6 rounded-lg shadow-lg max-w-sm w-full relative">
                                @csrf
                                    <input type="text" hidden name="ProductID" value="{{ $product->ProductID }}">
                                    <div class="flex justify-end p-4">
                                        <button type="button" @click="open = false" class="absolute top-2 right-2 bg-[#FFF3F3] text-black px-4 py-2 rounded hover:bg-red-600 hover:text-white">x</button>
                                    </div>
                                    <img src="{{ asset('storage/'. $product->image) }}" alt="Image of {{ $product->productName }}" class="w-full h-40 object-cover rounded-lg mb-4">
                                    <h2 class="text-lg font-bold mb-2">{{ $product->productName }}</h2>
                                    <p class="mt-2 font-semibold">₱ {{ $product->price }} / {{ $product->unit ?? 'srv' }}</p>
                                    <p class="text-sm text-gray-600">{{ $product->productDescription }}</p>
                                    <div x-data="{ quantity: 1 }" class="flex flex-col space-y-4 p-6">
                                        <!-- Row: Quantity Controls -->
                                        <div class="flex flex-row items-center justify-center space-x-2">
                                            <button type="button" @click="quantity = Math.max(1, quantity - 1)" 
                                                    class="bg-gray-200 px-3 py-1 rounded-full border-2 border-black hover:bg-gray-300">-</button>
                                            
                                                <div class="bg-white text-center py-1 px-8 rounded-lg flex items-center justify-center mx-4 shadow-lg">
                                                    <p x-text="quantity" class="text-xl font-semibold"></p>
                                                </div>
                                            
                                            <button type="button" @click="quantity++" 
                                                    class="bg-gray-200 px-3 py-1 rounded-full border-2 border-black hover:bg-gray-300">+</button>
                                            
                                            <!-- Hidden input to submit -->
                                            <input type="hidden" name="quantity" :value="quantity">
                                        </div>

                                        <!-- Row: Add to Cart Button -->
                                        <div>
                                            <button type="submit" class="bg-[#33FF33] text-white px-4 py-2 rounded-fullc1 w-full hover:bg-white hover:text-green-500 hover:outline-none hover:ring-2 hover:ring-green-500 hover:border-green-500">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                @endforeach
            </div>
        @endforeach
    </div>
</body>
</html>