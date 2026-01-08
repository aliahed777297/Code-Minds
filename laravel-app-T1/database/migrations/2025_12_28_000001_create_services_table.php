<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            // اسم الخدمة
            $table->string('name');

            // ✅ اسم ملف الصورة فقط (مثال: service-delivery.jpg)
            $table->string('image')->nullable();

            // وصف الخدمة
            $table->text('description')->nullable();

            // السعر
            $table->decimal('price', 10, 2);

            // مدة الخدمة بالدقائق
            $table->smallInteger('duration_minutes')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};
