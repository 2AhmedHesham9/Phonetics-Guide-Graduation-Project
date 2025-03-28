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
            $table->string('first_name')->isNotEmpty()->index();
            $table->string('last_name')->isNotEmpty()->index();
            $table->integer('years_of_experince')->isNotEmpty();
            $table->string('image')->nullable()->index();
            $table->date('date_of_birth')->isNotEmpty();
            $table->string('clinic_state')->isNotEmpty()->index();
            $table->string('clinic_city')->isNotEmpty()->index();
            $table->string('clinic_street')->isNotEmpty()->index();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number')->isNotEmpty()->unique();
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
