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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->nullable()->default('NULL');
            $table->string('description', 100)->nullable()->default('NULL');
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->string('modified_by', 50)->nullable()->default('NULL');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->string('created_by', 50)->nullable()->default('NULL');
        });

        DB::unprepared("INSERT INTO `courses` (`code`,`description`) VALUES ('ACCT','accounting'),('ACOM','Agricultural Communication'),('BUSS','Business'),('CASC','Computer Applied Subject Course'),('CBMC','Boarding Management Communication'),('CITE','Computer Information Technology'),('COSC','Computer Science'),('CTHC','Tourism Hospitality '),('ENGR','engineering'),('GEDC','general education'),('INSY','Information System'),('INTE','Information Technology'),('MMAR','Multimedia Arts'),('NSTP','National Service Training Program'),('OJTC','practicum'),('PHED','Physical Education'),('STIC','STI College'),('TOUR','Tourism ');
");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
