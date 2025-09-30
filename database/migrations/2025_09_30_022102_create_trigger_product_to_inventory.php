<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER after_product_insert
            AFTER INSERT ON products
            FOR EACH ROW
            BEGIN
                INSERT INTO inventory (ProductID, capacity, quantity, status, lastUpdated, created_at, updated_at)
                VALUES (NEW.ProductID, 50, 0, 'Empty', CURRENT_DATE, NOW(), NOW());
            END
        ");
    }

    public function down()
    {
        DB::unprepared("DROP TRIGGER IF EXISTS after_product_insert");
    }

};
