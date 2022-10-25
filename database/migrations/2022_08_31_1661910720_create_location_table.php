<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationTable extends Migration
{
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {

		$table->increments('id');
		$table->string('code',20)->nullable()->default('NULL');
		$table->string('description',100)->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->useCurrent();
		$table->string('modified_by',50)->nullable()->default('NULL');
		$table->timestamp('created_at')->nullable()->useCurrent();
		$table->string('created_by',50)->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('location');
    }
}