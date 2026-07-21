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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // id INT
            $table->string('nome', 100); // nome VARCHAR(100)
            $table->string('login_email', 100)->unique(); // login_email VARCHAR(100)
            $table->string('senha_hash', 255); // senha_hash VARCHAR(255)
            
            // Cargo restrito conforme o diagrama (Gestor/Administrador vs Equipe de Produção)
            $table->enum('cargo', ['ADM', 'PROD']); 
            
            // Status para controle de acesso ativo/inativo
            $table->boolean('status_ativo')->default(true); // status_ativo TINYINT(1)
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};