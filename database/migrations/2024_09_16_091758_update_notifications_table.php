<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Add nullable fields for single user or provider selection
            $table->unsignedBigInteger('user_id')->nullable()->after('id');  // For specific user
            $table->unsignedBigInteger('provider_id')->nullable()->after('user_id'); // For specific provider
    
            // Add JSON field for storing multiple users/providers if needed
            $table->json('user_ids')->nullable()->after('provider_id');  // For group of users
            $table->json('provider_ids')->nullable()->after('user_ids'); // For group of providers
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('provider_id');
            $table->dropColumn('user_ids');
            $table->dropColumn('provider_ids');
        });
    }
}
