<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('m_jabatan_id');
            $table->string('username');
            $table->string('name');
            $table->string('password');
            $table->string('sandi');
            $table->string('phone');
            $table->string('alamat');
            $table->boolean('status');
            $table->string('last_login')->nullable();
            $table->rememberToken();
            $table->unsignedBigInteger('m_role_id');
            
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
