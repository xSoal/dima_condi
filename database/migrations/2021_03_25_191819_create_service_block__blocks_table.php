<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateServiceBlockBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_block__blocks', function (Blueprint $table) {
            $table->id();
            $table->integer("service_block_id");
            $table->text("header_text");
            $table->text("text");
            $table->integer("price");
            $table->text("price_info");
            $table->timestamps();
        });


        foreach ([1,2,3,4] as $k){
            $for = $k++;
            $price = 2000 - ($k * 100);
            DB::table('service_block__blocks')->insert(
                array(
                    "service_block_id" => 1,
                    "header_text" => "$k - $for ед.",
                    "text" => "Установка залупы №$k",
                    "price" => $price,
                    "price_info" => "За 1 кондер",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                )
            );
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_block__blocks');
    }
}
