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
        CREATE VIEW unpaid_payment_view AS
        SELECT
        payments.PaymentID,
        orders.OrderID,
        payments.amountPayed,
        payments.amountChanged,
        orders.totalPrice,
        payments.status
        FROM payments
        JOIN orders ON payments.OrderID = orders.OrderID
        WHERE payments.status = 'Unpaid'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW unpaid_payment_view");
    }
};
