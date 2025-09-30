<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>System Status Table</title>
</head>
<body class="bg-[#094047]">
    <div class="flex">
        @include('staff.sidebar')

        <!-- Main Content -->
        <div x-data="restockHandler()" class="flex-1 p-8 overflow-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <!-- Header + Search -->
                <div class="grid grid-cols-2 gap-6 mb-4">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-gray-800">System Status Table</h1>
                    </div>
                    <div class="flex justify-end">
                        <div class="flex items-center">
                            <label for="search" class="text-gray-700 font-medium mr-2">Search</label>
                            <input
                                type="text"
                                id="search"
                                placeholder="Search..."
                                class="p-1 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                onkeyup="filterTable()"
                            >
                            <button class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 ml-2">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table -->
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
                                <td class="py-4 px-6 break-words whitespace-normal">
                                    <button 
                                        class="text-green-500 hover:underline"
                                        data-id="{{ $inventory->InventoryID }}"
                                        @click="openModal('{{ $inventory->InventoryID }}', '{{ $inventory->productName }}', {{ $inventory->quantity }}, '{{ asset('storage/'.$inventory->image) }}')">
                                        Restock
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Restock Modal -->
            <div x-show="modalOpen" @click.away="modalOpen = false"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

                <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full relative">
                    <button type="button" @click="modalOpen = false"
                            class="absolute top-2 right-2 text-gray-600 hover:text-red-500 text-xl">✕</button>
                    
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Restock Product</h2>
                    
                    <!-- Product Image and Info -->
                    <div class="flex items-center space-x-4 mb-6 pb-4 border-b">
                        <img :src="modalProductImage" alt="Product" class="h-24 w-24 object-cover rounded-lg border">
                        <div>
                            <p class="font-semibold text-lg text-gray-800" x-text="modalProductName"></p>
                            <p class="text-sm text-gray-600">Current Stock: <span class="font-medium" x-text="modalCurrentQuantity"></span></p>
                        </div>
                    </div>
                    
                    <div x-data="{ quantity: '' }" class="flex flex-col space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Restock Quantity</label>
                            <input 
                                type="number" 
                                x-model="quantity"
                                min="1"
                                placeholder="Enter quantity to add"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            />
                        </div>

                        <button 
                            @click="submitRestock(quantity)" 
                            :disabled="!quantity || quantity < 1"
                            :class="!quantity || quantity < 1 ? 'bg-gray-300 cursor-not-allowed' : 'bg-green-500 hover:bg-green-600'"
                            class="text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Confirm Restock
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Filter Script -->
    <script>
        function filterTable() {
            let input = document.getElementById("search");
            let filter = input.value.toLowerCase();
            let table = document.getElementById("statusTable");
            let trs = table.getElementsByTagName("tr");

            for (let i = 1; i < trs.length; i++) {
                let tds = trs[i].getElementsByTagName("td");
                let match = false;
                for (let j = 0; j < tds.length; j++) {
                    if (tds[j].innerText.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }
                trs[i].style.display = match ? "" : "none";
            }
        }
    </script>
    <script>
        function restockHandler() {
            return {
                modalOpen: false,
                modalInventoryID: null,
                modalProductName: '',
                modalCurrentQuantity: 0,
                modalProductImage: '',

                openModal(inventoryID, productName, qty, image) {
                    this.modalInventoryID = inventoryID;
                    this.modalProductName = productName;
                    this.modalCurrentQuantity = qty;
                    this.modalProductImage = image;
                    this.modalOpen = true;
                },

                submitRestock(quantity) {
                    if (!quantity || quantity < 1) {
                        alert("Please enter a valid quantity!");
                        return;
                    }

                    fetch(`/inventory/restock/${this.modalInventoryID}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ quantity: parseInt(quantity) })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Update table row instantly
                            let row = document.querySelector(`[data-id="${this.modalInventoryID}"]`).closest("tr");
                            row.querySelectorAll("td")[5].innerText = data.newQuantity;
                            row.querySelectorAll("td")[6].innerText = data.status;
                            row.querySelectorAll("td")[7].innerText = data.lastUpdated;

                            alert("Restocked successfully!");
                            this.modalOpen = false;
                        } else {
                            alert("Restock failed!");
                        }
                    })
                    .catch(() => alert("Error during restock!"));
                }
            }
        }
    </script>
</body>
</html>