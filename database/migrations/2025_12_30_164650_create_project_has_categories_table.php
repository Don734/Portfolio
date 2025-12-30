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
        Schema::disableForeignKeyConstraints();
        Schema::create('project_has_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->unique()
                ->constrained()
                ->onDelete('CASCADE');
            $table->foreignId('project_id')
                ->unique()
                ->constrained()
                ->onDelete('CASCADE');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('project_has_categories');
        Schema::enableForeignKeyConstraints();
    }
};
