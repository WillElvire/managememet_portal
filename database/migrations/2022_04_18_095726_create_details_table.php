<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->string('recepient_name');
            $table->string('receiver_name');
            $table->string('donor_name');
            $table->text('gift_content');
            $table->text('gift_element');
            $table->text('comment');
            $table->string('pourer_name')->nullable();
            $table->text('file_url')->nullable();
            $table->date('reception_date');
            $table->string('reception_agency');
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('details');
    }

}
