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
        //Post has many Tasks
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //Post id
            $table->integer('post_id')->unsigned()->nullable();

            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();

            $table->string('group_name')->nullable();
            $table->string('image')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();

            $table->string('order')->nullable();
            $table->string('status')->default('Active');

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->softDeletes();
        });

        //User task activity
        Schema::create('user_task_activity', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //User id
            $table->integer('user_id')->unsigned()->nullable();
            //Task id
            $table->integer('task_id')->unsigned()->nullable();
            //Task type: Like share, comment, follow etc
            $table->string('type')->nullable();

            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            //Action Url
            $table->string('action_url')->nullable();

            $table->string('group_name')->nullable();
            $table->string('image')->nullable();


            $table->string('order')->nullable();
            $table->string('status')->nullable()->default('Active');
            //Total view
            $table->integer('total_view')->nullable();
            //Total like
            $table->integer('total_like')->nullable();
            //Total share
            $table->integer('total_share')->nullable();


            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
