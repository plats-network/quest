<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();

            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('intro')->nullable();
            $table->text('content')->nullable();
            $table->string('type')->nullable();

            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('sponsors_id')->unsigned()->nullable();

            $table->string('category_name')->nullable();
            $table->integer('is_featured')->nullable();
            $table->string('featured_image')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_og_image')->nullable();
            $table->string('meta_og_url')->nullable();

            $table->integer('hits')->default(0)->unsigned();
            $table->integer('order')->nullable();
            $table->string ('status')->default(1);

            $table->integer('moderated_by')->unsigned()->nullable();
            $table->datetime('moderated_at')->nullable();

            $table->integer('created_by')->unsigned()->nullable();
            $table->string('created_by_name')->nullable();
            $table->string('created_by_alias')->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            //Start, end datetime
            $table->string('start_at')->nullable();
            $table->string('end_at')->nullable();

            //Total Token
            $table->string('reward_type')->nullable();
            $table->string('block_chain_network')->nullable();
            $table->string('category_token')->nullable();
            $table->integer('total_token')->nullable();
            $table->integer('total_person')->nullable();
            //Status lucky draw
            $table->string('status_lucky_draw')->nullable();
            $table->boolean('is_prize')->nullable()->default(false);

            $table->string('published_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        //Post User Followers
        Schema::create('post_user', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('post_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('post_user');
    }
}
