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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
        $table->foreignId('artisan_id')->constrained()->onDelete('cascade');
        $table->foreignId('problem_id')->constrained()->onDelete('cascade');
        $table->decimal('price', 8, 2);
        $table->text('description')->nullable();
        $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
        $table->boolean('urgent')->default(false);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
