<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Task;

return new class extends Migration {
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
            //Twitter Username, Url, Hashtag, Discord
            $table->string('value')->nullable();
            $table->text('description')->nullable();

            $table->string('group_name')->nullable();
            $table->string('image')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();

            $table->string('order')->nullable();

            $table->string('status')->nullable()->default('Active');

            $table->string('entry_type')->nullable()
                ->default(Task::TYPE_TWITTER_FOLLOW);
            //Twitter id
            $table->string('twitter_id')->nullable();
            //Twitter username
            $table->string('twitter_username')->nullable();
            //Discord id
            $table->string('discord_id')->nullable();

            //Task transfered type Token Holder - Check Balance, Transaction Activity
            $table->string('transfer_type')->nullable()
                ->default(Task::TRANSFER_TYPE_HOLDERS);
            //Total Token
            $table->string('total_token')->nullable();
            //Blockchain Network
            $table->string('block_chain_network')->nullable();  //Phala, Aleph Zero
            //Is Deposit Value to Admin wallet
            $table->string('deposit_status')->nullable()->default(false);


            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->softDeletes();
        });

        //Create User Task Status
        Schema::create('user_task_status', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //User id
            $table->integer('post_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            //Task id
            $table->integer('task_id')->unsigned()->nullable();

            $table->string('status')->nullable()->default('Open'); //Open, Completed, Failed
            //Url
            $table->string('url')->nullable();

            //Is Confirm From Admin
            $table->boolean('is_confirm')->nullable()->default(false);
            //DateTime Open
            $table->dateTime('date_open')->nullable();
            //DateTime Completed
            $table->dateTime('date_completed')->nullable();
            //Total Point
            $table->integer('total_point')->nullable();
            //Date Transfered
            $table->dateTime('date_transfered')->nullable();
        });

        //User task activity
        Schema::create('user_task_activity', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //User id
            $table->integer('post_id')->unsigned()->nullable();
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

        //User Reward
        Schema::create('user_rewards', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //User id
            $table->integer('post_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            //Task type: Like share, comment, follow etc
            $table->string('type')->nullable();
            //Transfer status
            $table->string('status')->nullable()->default('Pending'); //Pending, Completed, Failed
            //Date Transfered
            $table->dateTime('date_transfered')->nullable();
            //Date Created
            $table->dateTime('date_created')->nullable();
            //Total Point
            $table->integer('total_point')->nullable();
            //Total Token
            $table->integer('total_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('user_task_status');
        Schema::dropIfExists('user_rewards');
        Schema::dropIfExists('user_task_activity');
    }
};
