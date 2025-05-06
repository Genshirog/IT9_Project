@if ($cartItems->isNotEmpty())
    <div x-data="{ 
        openModal: false, 
        paymentMethod: '', 
        showGCashForm: {{ $errors->has('amountPayed') ? 'true' : 'false' }},
        showCashForm: false
    }">
        <!-- Total and Checkout -->
        <div class="flex justify-center items-center">
            <div class="flex justify-end items-center w-full max-w-4xl">
                <h3 class="text-xl font-bold mr-4">Total: ₱{{ $cartItems->sum('subTotal') }}</h3>
                <button type="button" @click="openModal = true" class="bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600">
                    Checkout
                </button>
            </div>
        </div>
        
        
        <!-- Payment Modal -->
        <div x-show="openModal" x-cloak class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 flex items-center justify-center overflow-auto">
            <!-- Modal Content -->
            <div class="bg-[#fef8f8] rounded-lg p-8 w-96 max-h-[90vh] overflow-y-auto">
                <h3 class="text-xl text-center font-bold mb-4">Select Payment Method</h3>
                <div class="flex space-x-4 justify-center p-6">
                    <!-- Cash Option -->
                    <label class="flex flex-col items-center space-y-2 cursor-pointer w-40">
                        <input type="radio" name="paymentMethod" value="cash" x-model="paymentMethod" class="hidden peer">
                        <div class="w-full h-full flex flex-col items-center justify-center bg-white peer-checked:border-green-500 peer-checked:ring-2 peer-checked:ring-green-300 p-4 rounded-xl border border-gray-200 shadow-md transition-transform duration-300 hover:scale-105">
                            <img src="{{ asset('images/cash.png') }}" alt="Cash" class="w-20 h-20 object-contain mb-2">
                            <span class="text-lg">Cash</span>
                        </div>
                    </label>
                    <!-- GCash Option -->
                    <label class="flex flex-col items-center space-y-2 cursor-pointer w-40">
                        <input type="radio" name="paymentMethod" value="gcash" x-model="paymentMethod" class="hidden peer">
                        <div class="w-full h-full flex flex-col items-center justify-center bg-white peer-checked:border-green-500 peer-checked:ring-2 peer-checked:ring-green-300 p-4 rounded-xl border border-gray-200 shadow-md transition-transform duration-300 hover:scale-105">
                            <img src="{{ asset('images/gcash-logo-1.png') }}" alt="GCash" class="w-20 h-20 object-contain mb-2">
                            <span class="text-lg">GCash</span>
                        </div>
                    </label>
                </div>
                <div class="mt-6 flex justify-between">
                    <button type="button" @click="openModal = false" class="bg-gray-300 text-black px-6 py-2 rounded-full hover:bg-gray-400">
                        Cancel
                    </button>

                    <button type="button" @click="
                        if (paymentMethod === 'gcash') {
                            showGCashForm = true;
                            openModal = false;
                        } else if (paymentMethod === 'cash'){
                            showCashForm = true;
                            $refs.cashForm.submit();
                            openModal = false;
                        }else {
                            $el.closest('form').submit();
                        }
                    " class="bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600">
                        Confirm Payment
                    </button>
                </div>
            </div>
        </div>


        <form x-ref="cashForm" action="{{ route('customer.payment') }}" method="POST" class="hidden">
            @csrf
            <input type="hidden" name="paymentMethod" value="cash">
        </form>
        <div x-show="showCashForm" x-cloak class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 flex items-center justify-center overflow-auto" x-init="setTimeout(() => showCashForm = false, 6000)">
            <div class="bg-white rounded-lg p-8 w-96 max-h-[90vh] overflow-y-auto text-center shadow-lg transform transition-all duration-300 ease-in-out">
                <span class="text-lg font-medium text-gray-700 mb-6 block"> Your order has been placed. Please prepare your cash payment.</span>
                <h1 class="text-2xl font-semibold text-gray-700 flex items-center justify-center mb-6">
                    <i class="fas fa-money-bill-wave text-green-500 mr-2"></i>
                    Cash Payment Confirmed!
                </h1>
                <div class="flex justify-center mt-6">
                    <button type="button" @click="showCashForm = false" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 focus:outline-none transition-all duration-200 ease-in-out">
                        OK
                    </button>
                </div>
            </div>
        </div>

        <!-- GCash Form Modal -->
        <div x-show="showGCashForm" x-cloak class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 flex items-center justify-center overflow-auto">
            <form action="{{ route('customer.payment') }}" method="POST" class="bg-white rounded-lg p-8 w-96">
                @csrf
                <input type="hidden" name="paymentMethod" value="gcash">
                <h3 class="text-xl font-bold mb-4 text-center">GCash Payment</h3>
                <div class="mb-4">
                    <label class="block text-gray-700">GCash Number</label>
                    <input type="text" name="gcash_number" class="w-full border rounded px-3 py-2 mt-1" placeholder="09XXXXXXXXX" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Amount:</label>
                    <input type="text" name="amountPayed" class="w-full border rounded px-3 py-2 mt-1" value="{{ old('amountPayed') }}" required>
                    @error('amountPayed')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-between mt-6">
                    <button type="button" @click="showGCashForm = false" class="bg-gray-300 text-black px-6 py-2 rounded-full hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600">
                        Pay Now
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif