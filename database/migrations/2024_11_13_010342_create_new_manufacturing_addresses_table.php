<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewManufacturingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_manufacturing_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('blk_blg_street_village')->nullable();  // Address or location-related information
            $table->string('region')->nullable();                   // Region (e.g., "Metro Manila")
            $table->string('province')->nullable();                 // Province (e.g., "Cebu")
            $table->string('district')->nullable();                 // District (e.g., "Central")
            $table->string('municipality')->nullable();             // Municipality (e.g., "Lapu-Lapu")
            $table->string('barangay')->nullable();      
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
        Schema::dropIfExists('new_manufacturing_addresses');
    }
}
