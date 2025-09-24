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
        DB::statement("CREATE VIEW `users_view` AS
SELECT 
    `bbq_lagao`.`users`.`UserID` AS `UserID`,
    CONCAT(`bbq_lagao`.`users`.`firstname`, ' ', `bbq_lagao`.`users`.`lastname`) AS `User`,
    `bbq_lagao`.`roles`.`roleName` AS `roleName`,
    `bbq_lagao`.`users`.`birthday` AS `birthday`,
    `bbq_lagao`.`users`.`email` AS `email`,
    `bbq_lagao`.`users`.`contactNumber` AS `contactNumber`,
    `bbq_lagao`.`users`.`address` AS `address`,
    `bbq_lagao`.`users`.`username` AS `username`,
    SHA2(`bbq_lagao`.`users`.`password`, 256) AS `password`
FROM 
    `bbq_lagao`.`users`
JOIN 
    `bbq_lagao`.`roles` 
    ON `bbq_lagao`.`users`.`RoleID` = `bbq_lagao`.`roles`.`RoleID`
WHERE 
    `bbq_lagao`.`users`.`RoleID` <> 1;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW users_view");
    }
};
