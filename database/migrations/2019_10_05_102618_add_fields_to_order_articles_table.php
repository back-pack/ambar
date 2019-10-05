<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToOrderArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_articles', function (Blueprint $table) {
            $table->string('name')->default('Sin nombre');
            $table->decimal('cost', 8, 2)->default(0.00);
            $table->decimal('weight', 8, 2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_articles', function (Blueprint $table) {
            //
        });
    }
}
