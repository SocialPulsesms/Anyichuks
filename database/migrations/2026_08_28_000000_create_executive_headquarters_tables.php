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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo_url')->nullable();
            $table->string('industry');
            $table->text('description');
            $table->string('leadership_role');
            $table->json('key_activities')->nullable();
            $table->string('website_url')->nullable();
            $table->json('related_images')->nullable();
            $table->json('related_news')->nullable();
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });

        Schema::create('impact_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category'); // Education, Healthcare, Housing, Women Empowerment, Youth & Sports, Community Development
            $table->string('location');
            $table->string('state')->default('Ebonyi');
            $table->integer('year');
            $table->text('description');
            $table->string('beneficiaries')->nullable();
            $table->json('photographs')->nullable();
            $table->json('videos')->nullable();
            $table->json('related_news')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });

        Schema::create('leadership_milestones', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->string('title');
            $table->string('stage'); // Early Career, Business Development, Business Expansion, Philanthropic Development, Community Impact, Public Leadership
            $table->text('description');
            $table->string('photograph_url')->nullable();
            $table->string('related_organization')->nullable();
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });

        Schema::create('media_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('date');
            $table->string('platform'); // TV, Youtube, News, Event, Podcast
            $table->string('category'); // Interviews, Speeches, Television, Events, Documentaries, Public Addresses
            $table->string('thumbnail_url')->nullable();
            $table->text('description')->nullable();
            $table->text('video_url');
            $table->string('related_topic')->nullable();
            $table->timestamps();
        });

        Schema::create('press_assets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category'); // Biography, Photography, Brand Asset, Foundation Profile, Business Profile, Press Kit
            $table->string('file_size')->nullable();
            $table->string('format')->nullable(); // PDF, ZIP, JPG, PNG
            $table->string('download_url');
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(true);
            $table->timestamps();
        });

        Schema::create('verified_claims', function (Blueprint $table) {
            $table->id();
            $table->string('claim');
            $table->string('category'); // Education, Business Leadership, Foundation Activities, Awards, Public Roles
            $table->string('source_name');
            $table->string('source_url')->nullable();
            $table->date('verification_date');
            $table->string('verified_by')->default('Executive Office Review Board');
            $table->text('details')->nullable();
            $table->timestamps();
        });

        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->string('award');
            $table->integer('year');
            $table->string('organization');
            $table->string('category');
            $table->text('description');
            $table->string('photograph_url')->nullable();
            $table->string('source_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('awards');
        Schema::dropIfExists('verified_claims');
        Schema::dropIfExists('press_assets');
        Schema::dropIfExists('media_items');
        Schema::dropIfExists('leadership_milestones');
        Schema::dropIfExists('impact_projects');
        Schema::dropIfExists('businesses');
    }
};
