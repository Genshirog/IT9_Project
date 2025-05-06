<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-[#094047] text-white">
    <div class="flex">
        @include('admin.sidebar')
        
        <!-- Main content area -->
        <div class="flex-1 p-6">
            <h1 class="text-3xl font-bold text-center mb-8">Sales Analytics Dashboard</h1>
            
            <!-- Sales Overview Section -->
            <div class="mb-10">
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
            </div>
            
            <!-- Best Selling Products Section -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Line Chart Script -->
    <script>
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
                        title: { display: true, text: 'Date' },
                        ticks: { color: 'white' },
                        grid: { color: 'rgba(255, 255, 255, 0.1)' }
                    },
                    y: {
                        title: { display: true, text: 'Total Sales' },
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

        // Handle chart type change
        document.getElementById('chartType').addEventListener('change', (event) => {
            const chartType = event.target.value;
            lineChart.data.labels = salesData[chartType].map(item => item.label);
            lineChart.data.datasets[0].data = salesData[chartType].map(item => item.total);
            lineChart.update();
        });
    </script>
</body>
</html>