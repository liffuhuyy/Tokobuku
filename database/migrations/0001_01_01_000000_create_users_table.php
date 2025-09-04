<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama pengguna
            $table->string('email')->unique(); // Email unik
            $table->timestamp('email_verified_at')->nullable(); // ✅ tambahkan ini
            $table->string('password'); // Password hash
            $table->enum('role', ['admin', 'owner', 'kasir'])->default('kasir'); // Role
            $table->rememberToken(); // Token untuk "remember me"
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Undo migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
