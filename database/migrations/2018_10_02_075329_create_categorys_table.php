<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        
        DB::table('categorys')->insert([
            'name' => 'Tour ngắn ngày'
        ]);
        
        DB::table('categorys')->insert([
            'name' => 'Tour dài ngày'
        ]);

        DB::table('categorys')->insert([
            'name' => 'Tour trong nước'
        ]);

        DB::table('categorys')->insert([
            'name' => 'Tour nước ngoài'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorys');
    }
}
