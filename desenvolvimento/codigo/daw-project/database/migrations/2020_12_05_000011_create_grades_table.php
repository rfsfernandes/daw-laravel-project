<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->integer('value');
            $table->unsignedBigInteger('id_enrollment');
            //$table->timestamps();

            // Foreign Keys
            $table->foreign('id_enrollment')->references('id')->on('inscription');
        });

        // Insert
        DB::table('grades')->insert(
            array(
                ['value' => 14,
                    'id_enrollment' => 3
                ],
                ['value' => 14,
                    'id_enrollment' => 4
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
        Schema::dropIfExists('grades');
    }
}
