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
        Schema::create('tag_presents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->index()->constrained('tags');
            $table->foreignId('present_id')->index()->constrained('presents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_presents');
    }
};
