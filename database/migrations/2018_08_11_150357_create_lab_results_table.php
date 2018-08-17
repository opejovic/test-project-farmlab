<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results', function (Blueprint $table) {
            $table->increments('id');
            $table->text('herd_number');
            $table->string('date_of_arrival');
            $table->string('date_of_test');
            $table->string('animal_id');
            $table->string('lab_code');
            $table->string('test_name');
            $table->string('type_of_samples');
            $table->string('reading');
            $table->string('interpretation');
            $table->string('farmer_name');
            $table->string('status')->default('UNPROCESSED');
            $table->text('vet_comment');
            $table->string('vet_indicator');
            $table->integer('practice_id');
            $table->integer('vet_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results');
    }
}
