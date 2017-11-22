<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); 
            $table->string('email');
            $table->string('tel_nummer');
            $table->timestamps();
        });

        // SQLSTATE[42S02]: Base table or view not found: 
        // 1146 Table 'mosselsoupe.product_subscriptions' doesn't exist (SQL: insert into `product_subscriptions` (`personen`, `product_id`, `subscriptions_id`) values (9, 1, 7))
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
