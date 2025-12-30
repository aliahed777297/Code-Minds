<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 128)->index();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->unsignedSmallInteger('quantity')->default(1);
            $table->tinyInteger('rating')->nullable();
            $table->text('comment')->nullable();
            $table->decimal('price_at_add', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};
