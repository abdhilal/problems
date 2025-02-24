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
        Schema::create('problem_artisans', function (Blueprint $table) {
            $table->id();
        $table->foreignId('problem_id')->constrained()->onDelete('cascade');
        $table->foreignId('artisan_id')->constrained()->onDelete('cascade');
        $table->decimal('price', 8, 2);
        $table->enum('status', ['pending', 'accepted', 'completed', 'rejected'])->default('pending');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('problem_artisans');
    }
};
