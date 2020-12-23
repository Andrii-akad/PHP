<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_posts', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tag')->index();
            $table->unsignedBigInteger('id_post')->index();
            $table->primary(['id_tag', 'id_post']);

            $table->foreign('id_tag')
                ->references('id')
                ->on('tags')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_post')
                ->references('id')
                ->on('posts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags_posts');
    }
}
