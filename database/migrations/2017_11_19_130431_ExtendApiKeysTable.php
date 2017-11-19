<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtendApiKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('api_keys')) {
            Schema::table('api_keys', function (Blueprint $table) {
                $table->string('service')->nullable()->after('key');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('api_keys')) {
            Schema::table('api_keys', function (Blueprint $table) {
                $table->dropColumn('service');
            });
        }
    }
}
