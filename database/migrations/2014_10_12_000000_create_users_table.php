<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('city')->nullable();
            $table->string('ZIP')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('phone')->nullable();
            $table->string('role')->default('user');

            $table->string('social_id')->nullable();    // add social_id column with varchar type
            $table->string('social_type')->nullable();  // add social_type column with varchar type

            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('github_id')->nullable();
            $table->string('twitter_id')->nullable();
           /* $table->string('linkedin_id')->nullable();
            $table->string('instagram_id')->nullable();
            $table->string('youtube_id')->nullable();
            $table->string('pinterest_id')->nullable();
            $table->string('skype_id')->nullable();
            $table->string('tumblr_id')->nullable();
            $table->string('reddit_id')->nullable();
            $table->string('snapchat_id')->nullable();
            $table->string('whatsapp_id')->nullable();
            $table->string('telegram_id')->nullable();
            $table->string('wechat_id')->nullable();
            $table->string('viber_id')->nullable();
            $table->string('line_id')->nullable();
            $table->string('wechatpay_id')->nullable();
            $table->string('alipay_id')->nullable();*/
            $table->string('telegram_id')->nullable();
            //Zalo
            $table->string('zalo_id')->nullable();


            $table->string('contact_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('website')->nullable();
            $table->boolean('enable_portal')->nullable();
            $table->integer('currency_id')->unsigned()->nullable();


            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('mobile')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('avatar')->nullable()->default('img/default-avatar.jpg');
            $table->tinyInteger('status')->default(1)->unsigned();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->integer('creator_id')->unsigned()->nullable();
            //guard_name
            $table->string('guard_name')->nullable();


            $table->rememberToken()->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        //User Profile Table

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
