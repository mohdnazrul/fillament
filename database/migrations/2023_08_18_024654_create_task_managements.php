<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('task_managements', function (Blueprint $table) {
            $table->id();
            $table->string('task_name', 255)->nullable();
            $table->longText('description')->nullable();
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('task_managements', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_managements', function (Blueprint $table) {
            $table->dropForeign('status_id');
            $table->dropForeign('user_id');
        });
        Schema::dropIfExists('status');
        Schema::dropIfExists('task_managements');
    }
};
