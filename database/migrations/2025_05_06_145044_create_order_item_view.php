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
        CREATE VIEW order_item_view AS
        SELECT 
            order_items.OrderID,
            order_items.OrderItemID,
            order_items.ProductID,
            products.productName,
            products.price,
            products.productDescription,
            order_items.quantity,
            products.image,
            order_items.subTotal
        FROM order_items
        JOIN products ON order_items.ProductID = products.ProductID
        JOIN orders ON order_items.OrderID = orders.OrderID;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS order_item_view");
    }
};
