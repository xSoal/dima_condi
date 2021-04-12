<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateServiceBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer("service_id");
            $table->integer("is_active");
            $table->timestamps();
        });


        DB::table('service_blocks')->insert(
            array(
                "title" => 'Скидки за обьем',
                "service_id" => 1,
                "is_active" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_blocks');
    }
}
