<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SiteUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_url', function (Blueprint $table) {
            $table->bigIncrements('site_id');
            $table->string('ee_id');
            $table->string('URL');
            $table->date('registration_date');
            $table->string('event_tag');
            $table->string('site_title');
            $table->string('site_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_url');
    }
}
