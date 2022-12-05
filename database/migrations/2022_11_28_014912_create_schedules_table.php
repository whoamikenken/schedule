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
        Schema::dropIfExists('schedules');

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('code', 40)->nullable();
            $table->string('description', 100)->nullable();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->string('modified_by', 50)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->string('created_by', 50)->nullable();
        });

        Schema::dropIfExists('schedules_detail');

        Schema::create('schedules_detail', function (Blueprint $table) {
            $table->id();
            $table->string('schedid', 20)->nullable();
            $table->time('starttime', $precision = 0);
            $table->time('endtime', $precision = 0);
            $table->string('dayofweek', 20)->nullable();
            $table->integer('idx')->nullable();
            $table->double('hours', 8, 2)->nullable();
            $table->string('subject', 40)->nullable();
            $table->string('section', 40)->nullable();
            $table->string('yearlevels', 40)->nullable();
            $table->string('coursecode', 40)->nullable();
            $table->string('units', 40)->nullable();
            $table->string('professor', 40)->nullable();
            $table->string('description', 100)->nullable();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->string('modified_by', 50)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->string('created_by', 50)->nullable();
        });

        Schema::create('schedules_detail_student', function (Blueprint $table) {
            $table->id();
            $table->string('schedid', 20)->nullable();
            $table->time('starttime', $precision = 0);
            $table->time('endtime', $precision = 0);
            $table->string('dayofweek', 20)->nullable();
            $table->integer('idx')->nullable();
            $table->double('hours', 8, 2)->nullable();
            $table->string('subject', 40)->nullable();
            $table->string('section', 40)->nullable();
            $table->string('yearlevels', 40)->nullable();
            $table->string('coursecode', 40)->nullable();
            $table->string('units', 40)->nullable();
            $table->string('professor', 40)->nullable();
            $table->string('description', 100)->nullable();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->string('modified_by', 50)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->string('created_by', 50)->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
