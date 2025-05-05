<nav class="bg-white shadow px-4 py-3 flex items-center justify-between" style="background: linear-gradient(to right, #FFBFBF 0%, #F27070 32%, #E93C3C 60%, #F8A8A8 100%)">
    <div class="flex items-center space-x-2">
        <img src="{{ asset('images/logo.png') }}" alt="BBQ Lagao" class="h-12 w-12">
        <span class="text-xl font-bold">BBQ Lagao and Beef Pares</span>
    </div>
    <ul class="flex space-x-6 items-center">
        <li><a href="#" class="text-gray-700 hover:text-blue-600"><i class="fas fa-home mr-2"></i>Home</a></li>
        <li><a href="#" class="text-gray-700 hover:text-blue-600"><i class="fas fa-shopping-cart mr-2"></i>Cart</a></li>
        <li><a href="#" class="text-gray-700 hover:text-blue-600"><i class="fas fa-history mr-2"></i>Order History</a></li>
        <li class="relative">
            <button id="userButton" class="flex items-center text-gray-700 hover:text-blue-600 focus:outline-none">
                <span><i class="fas fa-user mr-2"></i>User</span>
                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <!-- Dropdown -->
            <ul id="dropdown" class="absolute right-0 mt-2 w-40 bg-white shadow-md rounded-md hidden">
                <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"><i class="fas fa-cog mr-2"></i>Settings</a></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button onclick="document.getElementById('logout-form').submit();" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 w-full text-left">
                        Logout <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<script>
    const userButton = document.getElementById('userButton');
    const dropdown = document.getElementById('dropdown');

    // Toggle dropdown on button click
    userButton.addEventListener('click', function(event) {
        dropdown.classList.toggle('hidden'); // Toggle visibility
        event.stopPropagation(); // Prevent the click from closing the dropdown immediately
    });

    // Close the dropdown if the user clicks anywhere outside of the dropdown
    window.addEventListener('click', function(event) {
        if (!dropdown.contains(event.target) && !userButton.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
