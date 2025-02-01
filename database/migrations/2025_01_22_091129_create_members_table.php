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
    Schema::create('members', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('team_id');
        $table->string('name');
        $table->string('email');
        $table->string('password')->nullable();
        $table->string('phone')->nullable();
        $table->string('line_id')->nullable();
        $table->string('github_id')->nullable();
        $table->string('birth_place')->nullable();
        $table->date('birth_date')->nullable();
        $table->boolean('is_leader')->default(false);
        $table->timestamps();

        $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
