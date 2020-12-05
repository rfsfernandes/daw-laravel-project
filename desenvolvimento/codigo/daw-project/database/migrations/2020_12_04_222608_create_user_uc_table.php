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
            $table->integer('id_student');
            $table->integer('id_uc');
            //$table->timestamps();
        });

        // Insert
        DB::table('user_uc')->insert(
            array(
                ['id_student' => 1,
                    'id_uc' => 1
                ],
                ['id_student' => 1,
                    'id_uc' => 2
                ],
                ['id_student' => 2,
                    'id_uc' => 1
                ],
                ['id_student' => 2,
                    'id_uc' => 2
                ],
                ['id_student' => 3,
                    'id_uc' => 1
                ],
                ['id_student' => 3,
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
