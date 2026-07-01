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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_name')->nullable();
            $table->string('header_logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('hero_banner')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('about_image')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_description')->nullable();
            $table->string('event_schedule_title_1')->nullable();
            $table->text('event_schedule_description_1')->nullable();
            $table->string('event_schedule_title_2')->nullable();
            $table->text('event_schedule_description_2')->nullable();
            $table->string('prize_pool_amount')->nullable();
            $table->text('footer_description')->nullable();
            $table->string('location')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('platform_1_name')->nullable(); 
            $table->string('platform_1_link')->nullable();
            $table->string('platform_2_name')->nullable(); 
            $table->string('platform_2_link')->nullable();
            $table->string('platform_3_name')->nullable(); 
            $table->string('platform_3_link')->nullable();
            $table->string('platform_4_name')->nullable();
            $table->string('platform_4_link')->nullable();
            $table->string('copyright_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
