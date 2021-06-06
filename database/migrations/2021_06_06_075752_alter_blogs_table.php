<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('meta_tags')->after('blog_details')->nullable();
            $table->string('meta_keys')->after('meta_tags')->nullable();
            $table->string('meta_desc')->after('meta_keys')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('meta_tags');
            $table->dropColumn('meta_keys');
            $table->dropColumn('meta_desc');
        });
    }
}
