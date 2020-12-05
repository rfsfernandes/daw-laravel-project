<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school', function (Blueprint $table) {
            $table->id();
            $table->string('name_school');
            //$table->timestamps();
        });

        // Insert
        DB::table('school')->insert(
            array(
                ['name_school' => 'ESTIG'],
                ['name_school' => 'ESE'],
                ['name_school' => 'ESA'],
                ['name_school' => 'ESS']
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
        Schema::dropIfExists('school');
    }
}
