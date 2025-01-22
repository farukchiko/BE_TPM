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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->string('file_name', 100); // Batasi panjang nama file
            $table->text('file_path'); // Gunakan text jika path bisa panjang
            $table->timestamps();
        
            // Foreign key relasi ke tabel teams
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        
            // Indeks untuk optimasi query
            $table->index('team_id');
        });
        
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
