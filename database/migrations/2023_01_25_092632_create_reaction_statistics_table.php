<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateReactionStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('reaction_statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emoji_id')->index();
            $table->unsignedInteger('count')->default(0);
            $table->morphs('model');
            $table->timestamps();
            $table->unique(['emoji_id', 'model_id', 'model_type']);

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
        Schema::dropIfExists('reaction_statistics');
    }
}
