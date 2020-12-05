<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUserUcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_uc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_uc');
            //$table->timestamps();

            // Foreign Keys
            $table->foreign('id_user')->references('id')->on('user');
            $table->foreign('id_uc')->references('id')->on('curricular_unit');
        });

        // Insert
        DB::table('user_uc')->insert(
            array(
                ['id_user' => 1,
                    'id_uc' => 1
                ],
                ['id_user' => 1,
                    'id_uc' => 2
                ],
                ['id_user' => 2,
                    'id_uc' => 1
                ],
                ['id_user' => 2,
                    'id_uc' => 2
                ],
                ['id_user' => 3,
                    'id_uc' => 1
                ],
                ['id_user' => 3,
                    'id_uc' => 2
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
        Schema::dropIfExists('user_uc');
    }
}
