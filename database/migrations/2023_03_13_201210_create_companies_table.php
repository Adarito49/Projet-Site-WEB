<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('companies', function (Blueprint $table) {
			$table->id();
			$table->string('company_name');
			$table->string('sector');
			$table->string('street_number');
			$table->string('street_name');
			$table->string('postal_code');
			$table->string('city');
			$table->string('building');
			$table->string('floor');
			$table->integer('interns_number');
			$table->integer('pilot_trust');
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
        Schema::dropIfExists('companies');
    }
}
