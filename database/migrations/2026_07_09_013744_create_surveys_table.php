<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('surveys', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('gender');
        $table->json('ratings'); // لحفظ التقييمات (النجوم) كمصفوفة
        $table->string('recommendation');
        $table->integer('overall_rating');
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
