<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForeignKeyTagPIdToPostTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_tags', function (Blueprint $table) {
            $table->dropForeign('post_tags_tag_id_foreign');
            $table->foreign('tag_p_id')->references('id')->on('tag_ps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_tags', function (Blueprint $table) {
        });
    }
}
