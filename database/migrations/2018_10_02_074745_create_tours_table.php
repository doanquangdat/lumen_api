<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('date');
            $table->double('price');
            $table->integer('number_guest');
            $table->string('location')->nullable();
            $table->double('status')->default(1);
            $table->timestamps();
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categorys');
        });

        DB::table('tours')->insert([
            'name' => 'Tour Mộc Châu - Sơn La 3 ngày 2 đêm',
            'description' => 'Mộc Châu, một cao nguyên yên bình và xinh đẹp cách Hà Nội khoảng 200km hấp dẫn du khách bởi sự nguyên sơ và những nét văn hóa bản địa đặc sắc.',
            'date' => '10/10/2018',
            'price' => 990000,
            'number_guest' => 40,
            'location' => 'Mộc Châu - Sơn La',
            'category_id' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tours');
    }
}
