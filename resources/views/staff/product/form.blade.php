<form action="{{ route('staff.product.store') }}" method="POST" class="bg-black/30 p-10 rounded shadow-md backdrop-blur-sm space-y-6" enctype="multipart/form-data">
                    @csrf
                    <h1 class="text-center text-3xl font-bold mb-8 text-white">Add Product</h1>
                    <div class="flex flex-col items-center space-y-4">
                        <img id="previewImage" src="" alt="Product Image Here" class="w-30 h-20 object-cover rounded-md">
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden" onchange="previewFile()">
                        <button type="button" onclick="document.getElementById('imageInput').click()" class="bg-blue-500 text-white px-4 py-2 uppercase rounded-full hover:bg-blue-600">Upload a Photo of The Item</button>
                    </div>
                    @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <div class="grid grid-cols-2 gap-6"> <!-- 2 columns -->
                        <div class="flex flex-col">
                            <label class="text-white mb-1">Product Name:</label>
                            <input type="text" name="productName" class="p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Product Name">
                        </div>
                        @error('productName')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        <div class="flex flex-col">
                            <label class="text-white mb-1">Category</label>
                            <select name="category" class="p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select a category</option>
                                <option value="Beverage">Beverage</option>
                                <option value="Desert">Desert</option>
                                <option value="Dish">Dish</option>
                                <option value="Roasted">Roasted</option>
                                <!-- Add more as needed -->
                            </select>
                        </div>
                            @error('category')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        <div class="flex flex-col">
                            <label class="text-white mb-1">Description:</label>
                            <textarea name="productDescription" rows="3" class="p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" placeholder="Enter product productDescription"></textarea>
                        </div>
                            @error('productDescription')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        <div class="flex flex-col">
                            <label class="text-white mb-1">Price</label>
                            <input type="text" step="0.01" min="0" name="price" class="p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="0.00">
                        </div>
                    </div>
                            @error('price')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                    <div class="flex justify-center pt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-12 rounded-full text-lg">
                            Add Product
                        </button>
                    </div>
                </form>
                <script>
                    function previewFile() {
                        const file = document.getElementById('imageInput').files[0];
                        const preview = document.getElementById('previewImage');
                        const reader = new FileReader();
                        reader.onloadend = function () {
                            preview.src = reader.result;
                        };

                        if (file) {
                            reader.readAsDataURL(file);
                        } else {
                            preview.src = "";
                        }
                    }
                </script>