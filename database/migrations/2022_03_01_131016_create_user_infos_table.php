<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('address');

            //foreign key con user one to one
            //verrà collegata ad user
            $table->unsignedBigInteger('user_id'); //nome tabella da prendere
            $table->foreign('user_id') //nome chiave
                ->references('id') // quale referenza, in questo faco id
                ->on('users'); // su users

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
        Schema::dropIfExists('user_infos');
    }
}
