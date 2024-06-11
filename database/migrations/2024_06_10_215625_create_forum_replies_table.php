<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_replies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('content');
            $table->foreignId('forum_post_id')->constrained('forum_posts')->onDelete('cascade'); // Link to forum_posts
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to users
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forum_replies');
    }
};
