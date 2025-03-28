<?php

use App\Enums\Roles;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->isNotEmpty();
            $table->string('last_name')->isNotEmpty();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('role')->default(Roles::Admin->value);
            $table->rememberToken(); // Remember token (for "remember me" functionality)
            $table->timestamps(); // Created_at and updated_at timestamps
            $table->softDeletes(); // Deleted_at timestamp for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
