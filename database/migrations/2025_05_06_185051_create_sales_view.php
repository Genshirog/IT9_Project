<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW daily_sales_view AS
            SELECT DATE(orderDate) as label, SUM(totalPrice) as total
            FROM orders
            GROUP BY DATE(orderDate)
            ORDER BY DATE(orderDate)
        ");

        // Weekly sales view
        DB::statement("
            CREATE VIEW weekly_sales_view AS
            SELECT YEARWEEK(orderDate, 1) as label, SUM(totalPrice) as total
            FROM orders
            GROUP BY YEARWEEK(orderDate, 1)
            ORDER BY label
        ");

        // Monthly sales view
        DB::statement("
            CREATE VIEW monthly_sales_view AS
            SELECT DATE_FORMAT(orderDate, '%Y-%m') as label, SUM(totalPrice) as total
            FROM orders
            GROUP BY DATE_FORMAT(orderDate, '%Y-%m')
            ORDER BY label
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS daily_sales_view");
        DB::statement("DROP VIEW IF EXISTS weekly_sales_view");
        DB::statement("DROP VIEW IF EXISTS monthly_sales_view");
    }
};
