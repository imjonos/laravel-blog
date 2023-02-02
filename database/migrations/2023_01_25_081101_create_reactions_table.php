<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emoji_id')->index();
            $table->ipAddress('ip_address');
            $table->string('user_agent');
            $table->string('fingerprint')->index();
            $table->morphs('model');
            $table->timestamps();

            $table->foreign('emoji_id')
                ->references('id')
                ->on('emojis')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
}
