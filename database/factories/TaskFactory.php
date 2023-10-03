<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrTitle = [
            'BreederDodo - Twitter Followers',
            'Follow @BreederDodo on Twitter',
            'Follow @Scroll_ZKP on Twitter',
            'TWITTER Like @OmniFDN Tweet',
            'Retweet the Tweet'
        ];

        $arrValue = [
            'https://twitter.com/intent/retweet?tweet_id=1702595979642655123'
        ];

        return [
            'post_id' => rand(1, 5),
            'name' => substr($this->faker->text(20), 0, -1),
            'slug' => '',
            'description' => $this->faker->paragraph,
            'entry_type' => 1,
            'value' => 'https://twitter.com/intent/follow?screen_name=BreederDodo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
