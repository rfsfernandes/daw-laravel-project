<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->string('name_course');
            $table->integer('id_school');
            //$table->timestamps();
        });

        // Insert
        DB::table('course')->insert(
            array(
                ['name_course' => 'Engenharia Infomrática',
                    'id_school' => 1],

                ['name_course' => 'Audiovisual e Multimédia',
                    'id_school' => 2],

                ['name_course' => 'Solicitadoria',
                    'id_school' => 1],

                ['name_course' => 'Agronomia',
                    'id_school' => 3],

                ['name_course' => 'Enfermagem',
                    'id_school' => 4],

                ['name_course' => 'Gestão de Empresas',
                    'id_school' => 1]
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
        Schema::dropIfExists('course');
    }
}
