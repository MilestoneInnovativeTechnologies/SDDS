<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSDDSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sdds', function (Blueprint $table) {
            $table->id();
            $table->string('name',64)->index();
            $table->string('detail',256)->nullable();
            $table->string('domain',128)->nullable();
            $table->string('database',128)->nullable();
            $table->string('username',128)->nullable();
            $table->string('password',128)->nullable();
            $table->enum('active',['Y','N'])->default('Y');
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
        Schema::dropIfExists('s_d_d_s');
    }
}
