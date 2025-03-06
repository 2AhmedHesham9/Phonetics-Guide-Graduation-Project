<?php

use App\Enums\Roles;
use App\Enums\Gender;
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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->isNotEmpty();
            $table->string('last_name')->isNotEmpty();
            $table->LONGTEXT('medical_history')->isNotEmpty()->index();
            $table->string('image')->nullable()->index();
            $table->date('date_of_birth')->isNotEmpty();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number')->nullable();
            $table->enum('gender', Gender::values())->nullable();

            $table->rememberToken();
            $table->string('specified_id')->isNotEmpty()->unique();
            $table->string('role')->default(Roles::Patient->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
