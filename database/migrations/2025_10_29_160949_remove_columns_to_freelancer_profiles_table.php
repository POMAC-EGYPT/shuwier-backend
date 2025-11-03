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
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $table->dropColumn('twitter_link');
            $table->dropColumn('linkedin_link');
            $table->renameColumn('other_freelance_platform_links', 'other_links');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $table->string('twitter_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->renameColumn('other_links', 'other_freelance_platform_links');
        });
    }
};
