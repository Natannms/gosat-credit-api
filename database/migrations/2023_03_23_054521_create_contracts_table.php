<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // "instituicao":"PagPig",
        // "instituicao_id":3,
        // "codModalidade": "123456",

        // "offer_qnt_parcela_max":48,
        // "offer_qnt_parcela_min":12,
        // "offer_juros_mes":0.0495,
        // "offer_value_max":8000,
        // "offer_value_min":5000,

        // "hire_qnt_parcela_max":48,
        // "hire_value_max":4900
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('instituicao');
            $table->string('instituicao_id');
            $table->string('codModalidade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('offer_qnt_installments_max');
            $table->string('offer_qnt_installments_min');
            $table->string('offer_juros_mes');
            $table->string('offer_value_max');
            $table->string('offer_value_min');
            $table->string('hire_value');
            $table->string('hire_qnt_installments');
            $table->string('status')->default('Pendding');
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
        Schema::dropIfExists('contracts');
    }
};
