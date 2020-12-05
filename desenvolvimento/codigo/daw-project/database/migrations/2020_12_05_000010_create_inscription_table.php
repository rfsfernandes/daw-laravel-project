<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateInscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscription', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_assessment');
            $table->unsignedBigInteger('id_student');
            //$table->timestamps();

            // Foreign Keys
            $table->foreign('id_assessment')->references('id')->on('assessment');
            $table->foreign('id_student')->references('id')->on('user');
        });

        // Insert
        DB::table('inscription')->insert(
            array(
                ['id_assessment' => 1,
                    'id_student' => 1
                ],
                ['id_assessment' => 1,
                    'id_student' => 2
                ],
                ['id_assessment' => 2,
                    'id_student' => 1
                ],
                ['id_assessment' => 2,
                    'id_student' => 2
                ],
                ['id_assessment' => 3,
                    'id_student' => 1
                ],
                ['id_assessment' => 3,
                    'id_student' => 2
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
        Schema::dropIfExists('inscription');
    }
}
