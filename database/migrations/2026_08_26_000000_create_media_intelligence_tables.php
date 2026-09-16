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
        Schema::create('monitoring_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // rss, newsapi, google_news, youtube, social
            $table->json('api_config')->nullable();
            $table->integer('polling_interval')->default(900); // in seconds (e.g. 15 mins)
            $table->timestamp('last_successful_sync')->nullable();
            $table->text('last_error')->nullable();
            $table->json('rate_limit_status')->nullable();
            $table->boolean('is_enabled')->default(true);
            $table->timestamps();
        });

        Schema::create('tracked_keywords', function (Blueprint $table) {
            $table->id();
            $table->string('keyword')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('mention_clusters', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('summary')->nullable();
            $table->timestamp('first_detected_at');
            $table->timestamp('last_updated_at');
            $table->string('overall_sentiment')->default('neutral');
            $table->timestamps();
        });

        Schema::create('mention_sources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('domain')->nullable()->unique();
            $table->string('logo_url')->nullable();
            $table->timestamps();
        });

        Schema::create('mentions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mention_cluster_id')->nullable()->constrained('mention_clusters')->nullOnDelete();
            $table->foreignId('mention_source_id')->constrained('mention_sources')->onDelete('cascade');
            $table->foreignId('provider_id')->nullable()->constrained('monitoring_providers')->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->text('url')->unique();
            $table->text('canonical_url')->nullable();
            $table->string('content_hash')->unique();
            $table->string('matched_keyword');
            $table->string('sentiment')->default('neutral');
            $table->string('category')->default('Other');
            $table->string('importance')->default('low');
            $table->double('confidence_score')->default(1.0);
            $table->boolean('entity_confirmed')->default(true);
            $table->text('rejection_reason')->nullable();
            $table->timestamp('published_at');
            $table->timestamp('detected_at');
            $table->timestamps();

            $table->index('published_at');
            $table->index('detected_at');
            $table->index('entity_confirmed');
        });

        Schema::create('monitoring_runs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained('monitoring_providers')->onDelete('cascade');
            $table->string('status'); // success, failed
            $table->integer('items_fetched')->default(0);
            $table->integer('items_accepted')->default(0);
            $table->integer('items_rejected')->default(0);
            $table->text('error_message')->nullable();
            $table->timestamp('run_at');
            $table->timestamps();
        });

        Schema::create('alert_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('event_trigger'); // every_mention, high_importance, negative_mixed_sentiment, trend
            $table->json('trigger_conditions')->nullable();
            $table->json('channels'); // in_app, email, push
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alert_rule_id')->nullable()->constrained('alert_rules')->nullOnDelete();
            $table->foreignId('mention_id')->nullable()->constrained('mentions')->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->string('status')->default('unread'); // unread, read
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });

        Schema::create('sentiment_overrides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mention_id')->unique()->constrained('mentions')->onDelete('cascade');
            $table->string('old_sentiment');
            $table->string('new_sentiment');
            $table->string('overridden_by')->nullable();
            $table->timestamp('overridden_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sentiment_overrides');
        Schema::dropIfExists('alerts');
        Schema::dropIfExists('alert_rules');
        Schema::dropIfExists('monitoring_runs');
        Schema::dropIfExists('mentions');
        Schema::dropIfExists('mention_sources');
        Schema::dropIfExists('mention_clusters');
        Schema::dropIfExists('tracked_keywords');
        Schema::dropIfExists('monitoring_providers');
    }
};
