<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 20)->nullable()->default('NULL');
            $table->string('description', 100)->nullable()->default('NULL');
            $table->string('address', 100)->nullable()->default('NULL');
            $table->string('contact', 100)->nullable()->default('NULL');
            $table->string('location', 20)->nullable()->default('NULL');
            $table->string('jobsite', 20)->nullable()->default('NULL');
            $table->date('expiration_date')->nullable();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->string('modified_by', 50)->nullable()->default('NULL');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->string('created_by', 50)->nullable()->default('NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical');
    }
};
