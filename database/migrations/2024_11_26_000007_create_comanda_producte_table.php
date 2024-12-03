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
        Schema::create('comanda_producte', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('comanda_id')
            ->constrained(table:'comanda')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('producte_id')
            ->constrained(table:'producte')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('quantitat');
            $table->integer('preu_unitari');
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comanda_producte');
    }
};
