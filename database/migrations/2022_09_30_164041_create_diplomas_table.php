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
        Schema::create('diplomas', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_id', 30)->nullable();
            $table->string('type', 30)->nullable();
            $table->string('remarks', 30)->nullable();
            $table->text('diploma')->nullable();
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
        Schema::dropIfExists('diplomas');
    }
};
