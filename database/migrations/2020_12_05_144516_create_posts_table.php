<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description_short')->nullable();
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->boolean('is_published')->default(false);
            $table->unsignedBigInteger('id_category')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->timestamps();
            $table->foreign('id_category')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
