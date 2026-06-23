<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['apprenant', 'agent', 'invite', 'admin'])
                ->default('apprenant')
                ->after('is_admin');
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])
                ->default('approved')
                ->after('role');
            $table->text('approval_note')->nullable()->after('approval_status');
        });

        DB::statement("UPDATE users SET role = CASE WHEN is_admin = 1 THEN 'admin' ELSE 'apprenant' END");
        DB::statement("UPDATE users SET approval_status = 'approved' WHERE approval_status IS NULL");
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'approval_status', 'approval_note']);
        });
    }
};
