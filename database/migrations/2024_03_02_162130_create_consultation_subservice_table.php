<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationSubserviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultation_subservice', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consultation_id')
            ->constrained()
            ->cascadeOnDelete();
            
            $table->foreignId('subservice_id')
            ->constrained('subservicios')
            ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultation_subservice');
    }
}
