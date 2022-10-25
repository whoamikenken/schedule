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
        Schema::create('usertype', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->nullable()->default('NULL');
            $table->string('description', 50)->nullable()->default('NULL');
            $table->string('read', 250)->nullable();
            $table->string('add', 250)->nullable();
            $table->string('delete', 250)->nullable();
            $table->string('edit', 250)->nullable();
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
        Schema::dropIfExists('usertype');
    }
};
