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
            CREATE VIEW order_view AS
            SELECT
            payments.PaymentID,
            orders.OrderID,
            orders.UserID,
            payments.paymentMethod,
            payments.amountPayed,
            payments.amountChanged,
            orders.totalPrice,
            orders.deliveryType,
            orders.status AS orderStatus,
            payments.status AS paymentStatus,
            orders.orderDate
            FROM payments
            JOIN orders ON payments.OrderID = orders.OrderID
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW order_view");
    }
};
