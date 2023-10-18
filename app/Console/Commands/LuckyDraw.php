<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\UserReward;
use Illuminate\Console\Command;

class LuckyDraw extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:lucky-draw';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $allPosts = \App\Models\Post::all();
        //For each post
        /* @var Post $post */
        foreach ($allPosts as $post){
            $post_id = $post->id;
            //Check post has end
            if($post->isCompleteQuest()){
                //Model Post
                $post = Post::query()
                    ->where('id', '=', $post_id)
                    ->first();
                //Check post
                if (!$post) {
                    continue;
                }
                //$total_point = $post->total_point;
                $total_token = $post->total_token;

                //Create Reward For Random 5 user has play task
                UserReward::createReward($post_id, $total_token);

            }
        }
    }
}
