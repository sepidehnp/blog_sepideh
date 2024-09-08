<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('advertisings', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Spd\User\Models\User::class);
            $table->text('imagePath');
            $table->string('imageName');
            $table->string('link')->nullable();
            $table->string('title');
            $table->enum('location', Spd\Advertising\Models\Advertising::$locations);
            $table->timestamps();
        });
    }
 

    public function down()
    {
        Schema::dropIfExists('advertisings');
    }
};
