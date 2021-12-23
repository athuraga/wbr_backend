<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ['name','email','password','contact','vehicletype_id','address','lat','lang','min_order_amount','for_two_person','avg_delivery_time','license_number','admin_comission_type','admin_commision_value','vehicle_type','time_slots','tax','delivery_type_timeSlots','payment_option'];
        Schema::create('map', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('vehicletype_id');
            $table->string('lat');
            $table->string('lang');
            $table->string('license_number');
            $table->boolean('status');
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
        Schema::dropIfExists('map');
    }
}