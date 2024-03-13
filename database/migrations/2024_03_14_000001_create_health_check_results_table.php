<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthCheckResultsTable extends Migration
{
    public function up()
    {
        Schema::create('health_check_results', function (Blueprint $table) {
            $table->id();
            $table->string('check_name');
            $table->string('status');
            $table->text('message')->nullable();
            $table->longText('additional_data')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('health_check_results');
    }
}
