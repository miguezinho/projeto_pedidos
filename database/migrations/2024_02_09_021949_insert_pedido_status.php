<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table("pedido_status")->insert([
            [
                "descricao" => "Solicitado"
            ],
            [
                "descricao" => "Concluído"
            ],
            [
                "descricao" => "Cancelado"
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table("pedido_status")->truncate();
    }
};
