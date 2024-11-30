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
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('version_id')->index()->constrained();
            $table->foreignId('category_id')->index()->constrained();
            $table->string('component');
            $table->text('note')->nullable(); // Tambahkan note yang bisa optional
            $table->text('html')->nullable(); // Tambahkan kolom HTML
            $table->text('scss')->nullable(); // Tambahkan kolom SCSS/CSS
            $table->text('js')->nullable(); // Tambahkan kolom JS yang optional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
