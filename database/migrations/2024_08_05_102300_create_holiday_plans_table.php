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
        Schema::create('holiday_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title')->nullable(false);
            $table->text('description')->nullable(false);
            $table->text('location')->nullable(false);
            $table->json('participants')->nullable(true);
            $table->date('date');
            $table->timestamp('update_at');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('holiday_plans');
    }
};
