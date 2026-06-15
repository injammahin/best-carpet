<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePageSettingsTable extends Migration
{
    public function up(): void
    {
        Schema::create('home_page_settings', function (Blueprint $table) {
            $table->id();

            $table->string('hero_side_image_one')->nullable();
            $table->string('hero_side_image_two')->nullable();
            $table->string('hero_card_kicker')->nullable();
            $table->text('hero_card_text')->nullable();
            $table->json('hero_slides')->nullable();

            $table->string('visualizer_image')->nullable();
            $table->string('visualizer_kicker')->nullable();
            $table->string('visualizer_title')->nullable();
            $table->text('visualizer_text')->nullable();
            $table->json('visualizer_features')->nullable();

            $table->string('shop_room_image')->nullable();
            $table->string('shop_room_kicker')->nullable();
            $table->string('shop_room_title')->nullable();
            $table->text('shop_room_text')->nullable();
            $table->json('shop_room_items')->nullable();

            $table->json('recent_work_concepts')->nullable();

            $table->string('quote_image')->nullable();
            $table->string('quote_kicker')->nullable();
            $table->string('quote_title')->nullable();
            $table->text('quote_text')->nullable();
            $table->string('quote_phone')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_page_settings');
    }
}