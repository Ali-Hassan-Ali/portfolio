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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('title')->nullable();
            $table->text('link');

            $table->boolean('status')->default(0);
            $table->integer('index')->default(0);
            $table->index('index');

            $table->enum('type', \App\Enums\Admin\PageTypeEnum::values())->default(\App\Enums\Admin\PageTypeEnum::ALL->value);
            $table->foreignId('parent_id')->nullable()->constrained('menus')->nullOnDelete();
            $table->foreignIdFor(\App\Models\Admin::class);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
