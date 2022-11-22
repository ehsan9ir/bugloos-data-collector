<?php

use App\Models\Webservice;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Request;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webservices', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('url', 240)->unique();
            $table->enum('request_method', [Request::METHOD_GET, Request::METHOD_POST])->default(Request::METHOD_GET);
            $table->json('payload')->nullable();
            $table->string('token', 240)->nullable();
            $table->json('response_template');
            $table->enum('response_type', Webservice::$responseTypes)->default(Webservice::JSON_TYPE_RESPONSE);
            $table->enum('storage_type', Webservice::$storageTypes)->default(Webservice::GENERAL_TYPE_STORAGE);
            $table->string('storage_model', 140)->nullable();
            $table->string('schedule_frequency', 80)->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('webservices');
    }
};
