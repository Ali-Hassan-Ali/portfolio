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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->text('icon');
            $table->text('description');

            $table->boolean('status')->default(0);
            $table->integer('index')->default(0);
            $table->index('index');

            $table->foreignIdFor(\App\Models\Admin::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
