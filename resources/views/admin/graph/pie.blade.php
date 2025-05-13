<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('icon')
    <script src="{{ asset('js/tailwind.js')}}"></script>
    <link href="{{ asset('font_awesome/css/all.min.css')}}" rel="stylesheet">
</head>
<body class="bg-[#094047] text-white">
    <div class="flex">
        @include('admin.sidebar')
        <div class="flex-1 p-6">
            <h1 class="text-3xl font-bold text-center mb-8">Sales Analytics Dashboard</h1>
            <div>
                <div class="bg-[#0c5560] rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-semibold mb-4">Best Selling Products</h2>
                    <div class="flex justify-center items-center h-96">
                        <div class="w-full max-w-4xl h-full">
                            <canvas id="bestSellersChart" class="h-full w-full"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Best Sellers Chart Script -->
    <script src="{{ asset('js/chart.umd.min.js') }}"></script>
    <script>
        // Fetch best seller data passed from the controller
        const rawBestSellers = @json($bestSellers);
        console.log("Raw data from controller:", rawBestSellers);
        
        // Properly group sales by product name using simple addition
        const productSalesMap = {};
        
        // Process each row from the database
        rawBestSellers.forEach(item => {
            const productName = item.productName;
            // Convert to number and ensure it's an actual number
            const quantity = Number(item.totalSold);
            
            // Initialize if first time seeing this product
            if (!productSalesMap[productName]) {
                productSalesMap[productName] = 0;
            }
            
            // Add the EXACT quantity from this record (no multipliers)
            productSalesMap[productName] += quantity;
        });
        
        console.log("Aggregated product sales:", productSalesMap);
        
        // Extract labels and data for the chart
        const labels = Object.keys(productSalesMap);
        const data = Object.values(productSalesMap);
        
        // Generate colors (one per product)
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
        
        const colors = labels.map(() => getRandomColor());
        
        // Setup the chart with the correct data
        const bsCtx = document.getElementById('bestSellersChart').getContext('2d');
        const bestSellersChart = new Chart(bsCtx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Units Sold',
                    data: data,
                    backgroundColor: colors,
                    borderColor: 'white',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                layout: {
                    padding: {
                        right: 50
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                // Show the actual units sold, not calculated values
                                return `${label}: ${value} units`;
                            }
                        }
                    },
                    legend: {
                        position: 'right',
                        labels: {
                            color: 'white',
                            boxWidth: 20,
                            padding: 15,
                            usePointStyle: true
                        },
                        align: 'center',
                        maxHeight: 300
                    }
                }
            }
        });
    </script>
    @include('footer')
</body>
</html>