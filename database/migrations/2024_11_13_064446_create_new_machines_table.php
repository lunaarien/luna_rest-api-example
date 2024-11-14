<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_machines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manufacturing_id')->constrained('new_manufacturing_addresses')->onDelete('cascade');            $table->string('machine_name'); 
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
        Schema::dropIfExists('new_machines');
    }
}
