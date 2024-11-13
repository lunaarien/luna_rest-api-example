<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();  
            $table->string('machine_name'); 
            $table->string('brand');  
            $table->decimal('power_rating', 5, 2)->nullable(); 
            $table->date('manufactured_date')->nullable(); 
            $table->string('model_name')->nullable(); 
            $table->integer('rpm')->nullable();  
            $table->text('description_of_machine')->nullable(); 
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
        Schema::dropIfExists('machine');
    }
}
