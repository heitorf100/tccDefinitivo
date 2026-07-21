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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // Equivalente ao 'id INT' (Primary Key, Auto Increment)
            $table->string('nome_razao', 150); // VARCHAR(150)
            $table->string('cpf_cnpj', 20)->unique(); // VARCHAR(20) e adicionamos unique() pois não devem existir duplicatas
            $table->enum('tipo_pessoa', ['PF', 'PJ']); // ENUM('PF', 'PJ')
            $table->dateTime('data_cadastro')->useCurrent(); // DATETIME
            
            // O Laravel por padrão usa os timestamps created_at e updated_at. 
            // Vou incluí-los pois são excelentes para auditoria futura do sistema.
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};