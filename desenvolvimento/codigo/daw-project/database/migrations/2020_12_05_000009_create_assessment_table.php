<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment', function (Blueprint $table) {
            $table->id();
            $table->dateTime('datetime');
            $table->unsignedBigInteger('id_uc');
            $table->unsignedBigInteger('id_assessment_type');
            $table->unsignedBigInteger('id_epoch');
            //$table->timestamps();

            // Foreign Keys
            $table->foreign('id_uc')->references('id')->on('curricular_unit');
            $table->foreign('id_assessment_type')->references('id')->on('assessment_type');
            $table->foreign('id_epoch')->references('id')->on('assessment_epoch');
        });
        // Insert
        DB::table('assessment')->insert(
            array(
                ['datetime' => '2020-12-09 23:59:59',
                    'id_uc' => 1,
                    'id_assessment_type' => 3,
                    'id_epoch' => 1
                ],
                ['datetime' => '2020-12-04 23:59:59',
                    'id_uc' => 2,
                    'id_assessment_type' => 3,
                    'id_epoch' => 1
                ],
                ['datetime' => '2021-01-15 10:00:00',
                    'id_uc' => 1,
                    'id_assessment_type' => 1,
                    'id_epoch' => 1
                ],
                ['datetime' => '2021-02-25 14:00:00',
                    'id_uc' => 2,
                    'id_assessment_type' => 3,
                    'id_epoch' => 1
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
        Schema::dropIfExists('assessment');
    }
}
