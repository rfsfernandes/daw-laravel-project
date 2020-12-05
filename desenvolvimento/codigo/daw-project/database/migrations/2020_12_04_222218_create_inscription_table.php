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
            $table->integer('id_evaluation');
            $table->integer('id_student');
            //$table->timestamps();
        });

        // Insert
        DB::table('inscription')->insert(
            array(
                ['id_evaluation' => 1,
                    'id_student' => 1
                ],
                ['id_evaluation' => 1,
                    'id_student' => 2
                ],
                ['id_evaluation' => 2,
                    'id_student' => 1
                ],
                ['id_evaluation' => 2,
                    'id_student' => 2
                ],
                ['id_evaluation' => 3,
                    'id_student' => 1
                ],
                ['id_evaluation' => 3,
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
