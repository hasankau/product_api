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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->longText('description')->nullable();
            $table->string('code', 12)->regex('/^[a-zA-Z0-9]+$/');
            $table->string('category', 40);
            $table->text('image');
            $table->float('sellingPrice', 13,2)->default('0');
            $table->float('specialPrice', 13,2)->default('0');
            $table->enum('status', ['draft', 'published', 'out of stock'])->default('draft');
            $table->boolean('isDeliveryAvailable')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');
    }
};
