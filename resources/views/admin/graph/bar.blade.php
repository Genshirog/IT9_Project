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
                    <h2 class="text-2xl font-semibold mb-4">Product Sales Comparison</h2>
                    <div class="h-80">
                        <canvas id="productSalesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chart.js Library -->
    <script src="{{ asset('js/chart.umd.min.js') }}"></script>
    
    <script>
        // Get data from controller
        const bestSellers = @json($bestSellers);
        
        // Function to generate random colors
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            // Extract unique product names
            const products = [...new Set(bestSellers.map(item => item.productName))];
            
            // Calculate total sales per product
            const totalSalesPerProduct = products.map(product => {
                return bestSellers
                    .filter(item => item.productName === product)
                    .reduce((sum, item) => sum + item.totalSold, 0);
            });
            
            // Generate colors for each product
            const barColors = products.map(() => getRandomColor());
            
            // Create the chart
            const chartCtx = document.getElementById('productSalesChart').getContext('2d');
            const productSalesChart = new Chart(chartCtx, {
                type: 'bar',
                data: {
                    labels: products,
                    datasets: [{
                        label: 'Total Units Sold',
                        data: totalSalesPerProduct,
                        backgroundColor: barColors,
                        borderColor: barColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y', // Makes a horizontal bar chart (easier to read product names)
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Total Units Sold',
                                color: 'white'
                            },
                            beginAtZero: true,
                            ticks: { color: 'white' },
                            grid: { color: 'rgba(255, 255, 255, 0.1)' }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Product',
                                color: 'white'
                            },
                            ticks: { color: 'white' },
                            grid: { color: 'rgba(255, 255, 255, 0.1)' }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Hide legend since we only have one dataset
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Units Sold: ' + context.raw;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    @include('footer')
</body>
</html>