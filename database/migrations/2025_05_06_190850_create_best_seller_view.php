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
            CREATE VIEW best_selling_products AS
            SELECT 
                products.productName, 
                SUM(order_items.quantity) AS totalSold,
                orders.orderDate
            FROM 
                order_items
            JOIN 
                products ON order_items.ProductID = products.ProductID
            JOIN 
                orders ON order_items.OrderID = orders.OrderID
            GROUP BY 
                products.productName, orders.orderDate
            ORDER BY 
                totalSold DESC
            LIMIT 10;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW best_selling_products");
    }
};
