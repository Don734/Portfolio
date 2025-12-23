<?php

use App\Enums\ProjectStatus;
use App\Enums\ProjectType;
use App\Enums\ProjectVisibility;
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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string("slug")->unique();
            $table->string("status")->default(ProjectStatus::Draft->value);
            $table->string("type")->default(ProjectType::Website->value);;
            $table->timestamp("started_at");
            $table->timestamp("finished_at");
            $table->timestamp("published_at")->default(now());
            $table->string("priority")->default(0);
            $table->string("visibility")->default(ProjectVisibility::Private->value);;
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('projects');
        Schema::enableForeignKeyConstraints();
    }
};
