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
        Schema::create('products_model', function (Blueprint $table) {
            $table->id();
            $table->string('Product_Title');
            $table->string('Product_Description')->nullable();
            $table->decimal('Product_Price',5,2);
            $table->text('Product_Image_Path');
            $table->string('Product_Category')->index();
            $table->tinyInteger('Product_Status');   
            $table->dateTime('created_time')->nullable();
            $table->dateTime('modified_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_model');
    }
};
