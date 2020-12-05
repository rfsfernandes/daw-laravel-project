<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCurricularUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('curricular_unit', function (Blueprint $table) {
            $table->id();
            $table->string('name_uc');
            $table->integer('id_course');
            $table->integer('semester');
            //$table->timestamps();
        });

        // Insert
        DB::table('curricular_unit')->insert(
            array(
                ['name_uc' => 'DAW',
                    'id_course' => 1,
                    'semester' => 1
                ],

                ['name_uc' => 'PI',
                    'id_course' => 1,
                    'semester' => 1
                ],

                ['name_uc' => 'BD2',
                    'id_course' => 1,
                    'semester' => 1
                ],

                ['name_uc' => 'AM',
                    'id_course' => 1,
                    'semester' => 1
                ],

                ['name_uc' => 'MC',
                    'id_course' => 1,
                    'semester' => 1
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
        Schema::dropIfExists('curricular_unit');
    }
}
