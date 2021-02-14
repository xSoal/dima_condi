<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->timestamps();
        });

        // Insert some stuff
        $cats = [
            "Сервис бытовых кондиционеров",
            "Сервис систем кондиционирования",
            "Сервис вентиляционных систем"
        ];

        foreach ($cats as $cat){
            DB::table('service_categories')->insert(
                array(
                    "category_name" => $cat,
                    "created_at" =>  \Carbon\Carbon::now(),
                    "updated_at" =>  \Carbon\Carbon::now()
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
        Schema::dropIfExists('service_categories');
    }
}
