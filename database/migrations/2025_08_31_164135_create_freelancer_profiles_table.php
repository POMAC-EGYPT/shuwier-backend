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
        Schema::create('freelancer_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('linkedin_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->json('other_freelance_platform_links')->nullable();
            $table->string('portfolio_link')->nullable();
            $table->string('headline')->nullable();
            $table->text('description')->nullable();
            $table->enum('approval_status', ['requested', 'approved', 'rejected'])->default('requested');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_profiles');
    }
};
