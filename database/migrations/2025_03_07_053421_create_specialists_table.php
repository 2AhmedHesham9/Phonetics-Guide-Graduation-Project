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
        Schema::create('specialists', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->isNotEmpty();
            $table->string('last_name')->isNotEmpty();
            $table->integer('years_of_experince')->isNotEmpty();
            $table->string('image')->nullable()->index();
            $table->date('date_of_birth')->isNotEmpty();
            $table->string('clinic_state')->nullable();
            $table->string('clinic_city')->nullable();
            $table->string('clinic_street')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number')->nullable();
            $table->enum('gender', Gender::values())->nullable();

            $table->rememberToken();
            $table->string('nid')->isNotEmpty()->unique()->comment("National ID");
            $table->string('role')->default(Roles::Specialist->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialists');
    }
};
