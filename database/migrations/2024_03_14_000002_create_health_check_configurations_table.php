<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthCheckConfigurationsTable extends Migration
{
    public function up()
    {
        Schema::create('health_check_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('check_name');
            $table->boolean('is_enabled')->default(true);
            $table->json('settings')->nullable();
            $table->timestamps();
        });
    }

    public function down()
{
        Schema::dropIfExists('health_check_configurations');
    }
}
