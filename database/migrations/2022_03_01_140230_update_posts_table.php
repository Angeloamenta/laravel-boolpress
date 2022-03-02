<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')
            ->after('id')
            ->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')->onDelete('set null'); // on Delete('set null') in caso di eliminazione della colonna non si creano problemi
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // effettuo il drop in caso di reverse
            $table->dropForeign('posts_user_id_foreign'); 
            $table->dropColumn('user_id');
        });
    }
}
