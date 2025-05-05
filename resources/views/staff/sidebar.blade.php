<div class="sticky top-0 w-52 h-screen bg-[#18303c] rounded-xl shadow-lg p-5 flex flex-col justify-between">
        <div class="w-full mt-6">
            <ul class="space-y-4">
                <div class="text-center p-3">
                    <h1 class="text-white font-bold text-2xl">BBQ LAGAO</h1>
                </div>
                <li><img src="{{ asset('storage/'.$user->image) }}" alt="Profile" class="w-20 h-20 rounded-full mx-auto object-cover" /></li>
                <div class="text-center bg-[#1d3947] rounded-full mb-6">
                    <li><a href="{{ route('staff.profile') }}" class="text-white hover:text-blue-500 uppercase"><i class="fas fa-cog mr-2"></i><!--{{ $user->username }}-->Staff</a></li>
                </div>
                <li><a href="{{ route('staff.index') }}" class="text-white hover:text-blue-500"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
                <li>
                    <p class="text-white font-semibold"><i class="fas fa-box mr-2"></i>Product Management</p>
                    <ul class="ml-4 mt-2 space-y-2">
                        <li><a href="{{ route('staff.product.add') }}" class="text-gray-300 hover:text-blue-400"><i class="fas fa-plus-circle mr-2"></i>Add Product</a></li>
                        <li><a href="{{ route('staff.product.search') }}" class="text-gray-300 hover:text-blue-400"><i class="fas fa-search mr-2"></i>Check Product</a></li>
                    </ul>
                </li>
                <li>
                    <p class="text-white font-semibold"><i class="fas fa-wrench mr-2"></i>Site Management</p>
                    <ul class="ml-4 mt-2 space-y-2">
                        <li><a href="{{ route('staff.site.edit') }}" class="text-gray-300 hover:text-blue-400"><i class="fas fa-pencil-alt mr-2"></i>Add Product</a></li>
                    </ul>
                </li>
                <li>
                    <p class="text-white font-semibold"><i class="fas fa-cogs mr-2"></i>Graphs</p>
                    <ul class="ml-4 mt-2 space-y-2">
                        <li><a href="{{ route('staff.graph.bar') }}" class="text-gray-300 hover:text-blue-400"><i class="fas fa-chart-bar mr-2"></i>Bar Graph</a></li>
                        <li><a href="{{ route('staff.graph.line') }}" class="text-gray-300 hover:text-blue-400"><i class="fas fa-chart-line mr-2"></i>Line Graph</a></li>
                        <li><a href="{{ route('staff.graph.pie') }}" class="text-gray-300 hover:text-blue-400"><i class="fas fa-chart-pie mr-2"></i>Pie Graph</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="text-center">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-white hover:text-blue-500">Logout<i class="fas fa-arrow-right ml-2"></i></button>
            </form>
        </div>
    </div>