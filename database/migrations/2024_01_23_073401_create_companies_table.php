<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->string('name');
            $table->string('email');
            $table->uuid('industry_id')->nullable(false);
            $table->foreign('industry_id')->references('id')->on('industries');
            $table->uuid('country_id')->nullable(false);
            $table->foreign('country_id')->references('id')->on('countries');
            $table->uuid('state_id')->nullable(false);
            $table->foreign('state_id')->references('id')->on('states');
            $table->uuid('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->nullable();
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->integer('no_of_offices')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->string('map')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
