<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('yearlevels');
        
        Schema::create('yearlevels', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->nullable()->default('NULL');
            $table->string('description', 100)->nullable()->default('NULL');
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->string('modified_by', 50)->nullable()->default('NULL');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->string('created_by', 50)->nullable()->default('NULL');
        });

        DB::unprepared("INSERT INTO `yearlevels` (`code`,`description`) VALUES ('1Y1','1st year 1st term'),('1Y2','1st year 2nd term'),('2Y1','2nd year 1st term'),('2Y2','2nd year 2nd term'),('3Y1','3rd year 1st term'),('3Y2','3rd year 2nd term'),('4Y1','4th year 1st term'),('4Y2','4th year 2nd term'),('ELECTIVE','ELECTIVE')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yearlevels');
    }
};
