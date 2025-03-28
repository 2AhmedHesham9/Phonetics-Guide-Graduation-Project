<?php

use App\Enums\PatientStatus;
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
        Schema::create('patient_specialist', function (Blueprint $table) {
            $table->unsignedBigInteger('patient_id')->primary()->index();
            $table->unsignedBigInteger('specialist_id')->index();
            $table->text('notes')->nullable();
            $table->enum('status', PatientStatus::Values())->default(PatientStatus::Active->value);
            $table->date('start_date')->isNotEmpty();
            $table->date('end_date')->isNotEmpty();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('specialist_id')->references('id')->on('specialists')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_specialist');
    }
};
