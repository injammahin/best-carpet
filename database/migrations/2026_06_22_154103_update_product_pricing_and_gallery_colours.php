<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_ranges', function (Blueprint $table) {
            if (!Schema::hasColumn('product_ranges', 'base_price')) {
                $table->decimal('base_price', 10, 2)->default(0)->after('unit');
            }

            if (!Schema::hasColumn('product_ranges', 'selected_size_option_ids')) {
                $table->json('selected_size_option_ids')->nullable()->after('base_price');
            }

            if (!Schema::hasColumn('product_ranges', 'price_mode')) {
                $table->string('price_mode')->default('per_sqm')->after('selected_size_option_ids');
            }
        });

        Schema::create('product_gallery_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_range_id')->constrained('product_ranges')->cascadeOnDelete();
            $table->string('image');
            $table->string('colour_name')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        if (Schema::hasColumn('product_ranges', 'gallery')) {
            DB::table('product_ranges')
                ->whereNotNull('gallery')
                ->orderBy('id')
                ->chunkById(50, function ($products) {
                    foreach ($products as $product) {
                        $gallery = json_decode($product->gallery, true);

                        if (!is_array($gallery)) {
                            continue;
                        }

                        foreach ($gallery as $index => $image) {
                            if (!$image) {
                                continue;
                            }

                            DB::table('product_gallery_images')->insert([
                                'product_range_id' => $product->id,
                                'image' => $image,
                                'colour_name' => null,
                                'sort_order' => $index,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                });
        }

        if (Schema::hasTable('product_range_prices')) {
            $priceRows = DB::table('product_range_prices')
                ->select('product_range_id', DB::raw('MIN(price) as min_price'))
                ->whereNotNull('price')
                ->where('price', '>', 0)
                ->groupBy('product_range_id')
                ->get();

            foreach ($priceRows as $row) {
                $sizeIds = DB::table('product_range_prices')
                    ->where('product_range_id', $row->product_range_id)
                    ->whereNotNull('price')
                    ->where('price', '>', 0)
                    ->pluck('product_size_option_id')
                    ->filter()
                    ->values()
                    ->all();

                DB::table('product_ranges')
                    ->where('id', $row->product_range_id)
                    ->update([
                        'base_price' => $row->min_price,
                        'selected_size_option_ids' => json_encode($sizeIds),
                    ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('product_gallery_images');

        Schema::table('product_ranges', function (Blueprint $table) {
            if (Schema::hasColumn('product_ranges', 'base_price')) {
                $table->dropColumn('base_price');
            }

            if (Schema::hasColumn('product_ranges', 'selected_size_option_ids')) {
                $table->dropColumn('selected_size_option_ids');
            }

            if (Schema::hasColumn('product_ranges', 'price_mode')) {
                $table->dropColumn('price_mode');
            }
        });
    }
};