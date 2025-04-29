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
            CREATE VIEW users_view AS
            SELECT UserID, 
                CONCAT(firstname, ' ', lastname) AS 'User',  -- Correct string concatenation
                roles.roleName,
                birthday,
                email,
                contactNumber,
                address,
                username,
                password
            FROM users
            JOIN roles ON users.RoleID = roles.RoleID
            WHERE users.RoleID <> 1
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS users_view');
    }
};
