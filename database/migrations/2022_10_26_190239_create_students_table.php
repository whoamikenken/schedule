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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 30)->nullable();
            $table->string('campus', 30)->nullable();
            $table->string('adviser', 30)->nullable();
            $table->string('section', 30)->nullable();
            $table->string('year_level', 30)->nullable();
            $table->string('fname', 30)->nullable();
            $table->string('mname', 30)->nullable();
            $table->string('lname', 30)->nullable();
            $table->string('contact', 30)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('address', 50)->nullable();
            $table->string('family_contact_name', 30)->nullable();
            $table->string('family_contact', 30)->nullable();
            $table->string('gender', 30)->nullable()->default('Female');
            $table->date('date_applied')->nullable();
            $table->text('user_profile')->nullable();
            $table->string('isactive', 30)->nullable()->default('Active');
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->string('modified_by', 30)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->string('created_by', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
