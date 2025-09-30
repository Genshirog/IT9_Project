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
        Schema::create('movement', function (Blueprint $table) {
            $table->bigIncrements("MovementID");
            $table->unsignedBigInteger("InventoryID");
            $table->string("changeType");
            $table->unsignedInteger("quantityChange");
            $table->string("reason");
            $table->date(column: "dateTime")->default(DB::raw('CURRENT_DATE'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movement');
    }
};
