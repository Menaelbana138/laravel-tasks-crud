<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // عنوان المهمة
            $table->text('description')->nullable(); // تفاصيل المهمة
            $table->enum('status', ['Pending', 'Done'])->default('Pending'); // حالة المهمة
            $table->date('due_date')->nullable(); // تاريخ التسليم
            $table->softDeletes(); // حذف مؤقت (soft delete)
            $table->timestamps(); // created_at و updated_at
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
