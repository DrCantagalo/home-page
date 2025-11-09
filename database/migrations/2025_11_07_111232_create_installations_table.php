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
        Schema::create('installations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            $table->string('site_url');
            $table->string('installation_hash')->unique();
            $table->string('installation_code')->unique();
            $table->string('api_token');
            $table->string('api_token_enc')->nullable();
            $table->string('package_version')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('sanctum_token_enc')->nullable()
            $table->text('sanctum_token_hash')->nullable()

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installations');
    }
};
