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
        Schema::create('presents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('url_link');
            $table->string('description')->nullable();
            $table->longText('image')->nullable();
            $table->text('comment')->nullable();
            $table->foreignId('holiday_id')->index()->constrained('holidays')->onDelete('cascade');
            $table->boolean('choose_present')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presents');
    }
};
