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
        CREATE VIEW items_view AS
        SELECT 
            cart_items.CartID,
            cart_items.CartItemID,
            cart_items.ProductID,
            products.productName,
            products.price,
            products.productDescription,
            cart_items.quantity,
            products.image,
            cart_items.subTotal
        FROM cart_items
        JOIN products ON cart_items.ProductID = products.ProductID
        JOIN carts ON cart_items.CartID = carts.CartID;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW items_view");
    }
};
