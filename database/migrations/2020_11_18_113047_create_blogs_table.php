<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('blog_title', 100);
            $table->string('blog_slug', 100);

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->string('blog_summery');
            $table->text('blog_details');
            $table->string('thumbnail', 100);
            $table->softDeletesTz($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('blogs');
    }
}
