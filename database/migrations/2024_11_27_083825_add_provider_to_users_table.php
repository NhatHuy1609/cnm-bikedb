<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('provider')->nullable(); 
            $table->string('provider_id')->nullable(); 
            $table->string('password')->nullable()->change(); 
            $table->foreignId('role_id')->default(2)->nullable()->constrained('roles'); 
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['provider', 'provider_id']);
            $table->string('password')->nullable(false)->change();
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
}; 