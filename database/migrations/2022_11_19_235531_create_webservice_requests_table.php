<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webservice_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('webservice_id');
            $table->foreign('webservice_id')->on('webservices')->references('id');
            $table->nullableMorphs('modelable');
            $table->boolean('is_success')->default(true);
            $table->string('status_code')->default(Response::HTTP_OK);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webservice_requests');
    }
};
