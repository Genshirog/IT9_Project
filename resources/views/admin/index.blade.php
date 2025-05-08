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

            <!-- Grid layout for both sections -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Sales Overview -->
                <div class="bg-[#0c5560] rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-semibold mb-4">Sales Overview</h2>
                    <form id="chartForm" class="mb-4">
                        <label for="chartType" class="mr-2">Time Period:</label>
                        <select id="chartType" name="chartType" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md">
                            <option value="daily" selected>Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </form>
                    <div class="h-80">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>

                <!-- Best Selling Products -->
                <div class="bg-[#0c5560] rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-semibold mb-4">Best Selling Products</h2>
                    <div class="flex justify-center items-center h-80">
                        <div class="w-full max-w-md">
                            <canvas id="bestSellersChart" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-[#0c5560] rounded-lg shadow-lg p-6 mt-8 w-full">
                <h2 class="text-2xl font-semibold mb-4">Product Sales Comparison</h2>
                <div class="h-80">
                    <canvas id="totalSalesBarChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="{{ asset('js/chart.umd.min.js') }}"></script>

    <script>
        // ==== Sales Overview Line Chart ====
        const dailySales = @json($dailySales);
        const weeklySales = @json($weeklySales);
        const monthlySales = @json($monthlySales);

        const salesData = {
            daily: dailySales.map(item => ({ label: item.label, total: item.total })),
            weekly: weeklySales.map(item => ({ label: item.label, total: item.total })),
            monthly: monthlySales.map(item => ({ label: item.label, total: item.total }))
        };

        const chartConfig = {
            type: 'line',
            data: {
                labels: salesData.daily.map(item => item.label),
                datasets: [{
                    label: 'Sales',
                    data: salesData.daily.map(item => item.total),
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: { display: true, text: 'Date', color: 'white' },
                        ticks: { color: 'white' },
                        grid: { color: 'rgba(255, 255, 255, 0.1)' }
                    },
                    y: {
                        title: { display: true, text: 'Total Sales', color: 'white' },
                        ticks: { color: 'white' },
                        grid: { color: 'rgba(255, 255, 255, 0.1)' }
                    }
                },
                plugins: {
                    legend: {
                        labels: { color: 'white' }
                    }
                }
            }
        };

        const ctx = document.getElementById('lineChart').getContext('2d');
        let lineChart = new Chart(ctx, chartConfig);

        document.getElementById('chartType').addEventListener('change', (event) => {
            const chartType = event.target.value;
            lineChart.data.labels = salesData[chartType].map(item => item.label);
            lineChart.data.datasets[0].data = salesData[chartType].map(item => item.total);
            lineChart.update();
        });

        // ==== Best Selling Products Pie Chart ====
        const bestSellers = @json($bestSellers);
        const productSalesMap = {};
        
        bestSellers.forEach(item => {
            if (!productSalesMap[item.productName]) {
                productSalesMap[item.productName] = 0;
            }
            productSalesMap[item.productName] += item.totalSold;
        });

        const pieLabels = Object.keys(productSalesMap);
        const pieData = Object.values(productSalesMap);

        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        const pieColors = pieLabels.map(() => getRandomColor());

        const bsCtx = document.getElementById('bestSellersChart').getContext('2d');
        const bestSellersChart = new Chart(bsCtx, {
            type: 'pie',
            data: {
                labels: pieLabels,
                datasets: [{
                    label: 'Total Sales',
                    data: pieData,
                    backgroundColor: pieColors,
                    borderColor: 'white',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: 'white',
                            boxWidth: 20,
                            padding: 15,
                            usePointStyle: true
                        }
                    }
                }
            }
        });

        // ==== Total Sales Bar Chart ====
        // Extract product names and sales data from bestSellers
        const products = [...new Set(bestSellers.map(item => item.productName))];
        const totalSalesPerProduct = products.map(product => {
            return bestSellers
                .filter(item => item.productName === product)
                .reduce((sum, item) => sum + item.totalSold, 0);
        });

        // Set up Bar Chart
        const barCtx = document.getElementById('totalSalesBarChart').getContext('2d');
        const barColors = products.map(() => getRandomColor());
        
        const totalSalesBarChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: products,
                datasets: [{
                    label: 'Total Units Sold',
                    data: totalSalesPerProduct,
                    backgroundColor: barColors,
                    borderColor: barColors.map(color => color.replace('0.8', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Product',
                            color: 'white'
                        },
                        ticks: { color: 'white' },
                        grid: { color: 'rgba(255, 255, 255, 0.1)' }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total Units Sold',
                            color: 'white'
                        },
                        ticks: { color: 'white' },
                        grid: { color: 'rgba(255, 255, 255, 0.1)' }
                    }
                },
                plugins: {
                    legend: {
                        labels: { color: 'white' }
                    }
                }
            }
        });
    </script>
    @include('footer')
</body>
</html>