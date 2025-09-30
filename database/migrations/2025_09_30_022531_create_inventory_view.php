<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("DROP VIEW IF EXISTS inventory_view");
        DB::statement("CREATE VIEW inventory_view AS
SELECT 
    i.InventoryID,
    p.image,
    p.productName,
    p.category,
    i.capacity,
    i.quantity,
    i.status,
    i.lastUpdated
FROM products p
JOIN inventory i ON p.ProductID = i.ProductID
ORDER BY i.quantity ASC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS inventory_view");
    }
};
