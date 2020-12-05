<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('id_user_type');
            $table->unsignedBigInteger('id_course');
            $table->rememberToken();
            //$table->timestamps();

            // Foreign Keys
            $table->foreign('id_user_type')->references('id')->on('user_type');
            $table->foreign('id_course')->references('id')->on('course');
        });

        // Insert
        DB::table('user')->insert(
            array(
                ['name' => 'Pedro Parreira',
                    'email' => 'pedro.parreira@email.com',
                    'password' => 'pedroparreira',
                    'id_user_type' => '2',
                    'id_course' => '1',
                ],
                ['name' => 'Rodrigo Fernandes',
                    'email' => 'rodrigo.fernandes@email.com',
                    'password' => 'rodrigofernandes',
                    'id_user_type' => '2',
                    'id_course' => '1',
                ],
                ['name' => 'Luís Bruno',
                    'email' => 'luis.bruno@email.com',
                    'password' => 'luisbruno',
                    'id_user_type' => '1',
                    'id_course' => '1',
                ]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
