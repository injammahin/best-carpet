<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('company')->nullable();

            $table->json('preferred_contact')->nullable();
            $table->boolean('subscribe')->default(false);

            $table->json('job_type');
            $table->text('installation_address');
            $table->string('suburb');
            $table->string('postcode');

            $table->json('rooms');
            $table->json('products');
            $table->json('suitable_days');

            $table->string('local_store');
            $table->text('comments')->nullable();

            $table->string('status')->default('new');
            $table->timestamp('read_at')->nullable();

            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index('read_at');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};