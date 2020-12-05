<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_type', function (Blueprint $table) {
            $table->id();
            $table->string('name_evaluation');
            //$table->timestamps();
        });

        // Insert
        DB::table('assessment_type')->insert(
            array(
                ['name_evaluation' => 'Frequência'],
                ['name_evaluation' => 'Exame'],
                ['name_evaluation' => 'Projeto']
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
        Schema::dropIfExists('assessment_type');
    }
}
