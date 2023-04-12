<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailerLiteApiKeysTable extends Migration
{
    public function up()
    {
        Schema::create('mailer_lite_api_keys', function (Blueprint $table) {
            $table->id();
            $table->string('api_key')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mailer_lite_api_keys');
    }
}