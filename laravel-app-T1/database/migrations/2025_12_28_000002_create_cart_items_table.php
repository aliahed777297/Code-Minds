<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // في ملف migration الخاص بـ cart_items
Schema::create('cart_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
    $table->string('session_id')->nullable(); // تغيير هنا
    $table->foreignId('service_id')->constrained()->onDelete('cascade');
    $table->integer('quantity')->default(1);
    $table->decimal('price_at_add', 8, 2);
    $table->timestamps();
    
    $table->index(['user_id', 'session_id', 'service_id']);
});
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};
