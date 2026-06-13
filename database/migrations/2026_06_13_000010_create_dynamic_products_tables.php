<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('product_categories')
                ->nullOnDelete();

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['parent_id', 'is_active']);
        });

        Schema::create('product_size_options', function (Blueprint $table) {
            $table->id();

            $table->string('label');
            $table->decimal('sqm', 10, 2)->default(1);
            $table->string('size_group')->default('Standard');

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });

        Schema::create('product_ranges', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained('product_categories')
                ->restrictOnDelete();

            $table->foreignId('subcategory_id')
                ->nullable()
                ->constrained('product_categories')
                ->nullOnDelete();

            $table->string('name');
            $table->string('slug')->unique();

            $table->string('badge')->default('Popular');
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            $table->string('main_image')->nullable();
            $table->json('gallery')->nullable();
            $table->json('features')->nullable();

            $table->decimal('rating', 3, 1)->default(4.8);
            $table->string('unit')->default('m²');

            $table->string('colour_group')->nullable();
            $table->string('size_group')->nullable();
            $table->string('room')->nullable();

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['category_id', 'subcategory_id', 'is_active']);
        });

        Schema::create('product_colours', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_range_id')
                ->constrained('product_ranges')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('swatch')->default('#d8c7b5');
            $table->string('colour_group')->nullable();

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });

        Schema::create('product_range_prices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_range_id')
                ->constrained('product_ranges')
                ->cascadeOnDelete();

            $table->foreignId('product_size_option_id')
                ->constrained('product_size_options')
                ->cascadeOnDelete();

            $table->decimal('price', 10, 2);
            $table->decimal('regular_price', 10, 2)->nullable();

            $table->timestamps();

            $table->unique(['product_range_id', 'product_size_option_id'], 'range_size_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_range_prices');
        Schema::dropIfExists('product_colours');
        Schema::dropIfExists('product_ranges');
        Schema::dropIfExists('product_size_options');
        Schema::dropIfExists('product_categories');
    }
};