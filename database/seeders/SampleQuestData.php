<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\UserTaskStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

//Call: php artisan db:seed --class=SampleQuestData
class SampleQuestData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Auth::loginUsingId(1);

        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        echo "Truncate: taggables \n";
        DB::table('taggables')->truncate();

        echo "Truncate: tags \n";
        DB::table('tags')->truncate();
        echo "Truncate: tasks \n";
        DB::table('tasks')->truncate();
        DB::table('user_task_status')->truncate();
        DB::table('user_rewards')->truncate();

        /*
         * Tag Seed
         * ------------------
         */
        // Populate the pivot table
        echo " Insert: tags \n\n";
        $tags = $this->createSampleTags();
        foreach($tags as $tag) {
            $tag['created_by'] = 1;
            $tag['updated_by'] = 1;
            Tag::create($tag);
        }

        /*
         * Category Seed
         * ------------------
         */
        echo "\nTruncate: categories \n";
        DB::table('categories')->truncate();

        echo " Insert: categories \n\n";
        $categories = $this->createSampleCategories();
        foreach($categories as $category) {
            $category['created_by'] = 1;
            $category['updated_by'] = 1;
            Category::create($category);
        }

        /*
         * Posts Seed
         * ------------------
         */
        $numOfCategories = count($categories);
        echo "Truncate: posts \n";
        DB::table('posts')->truncate();

        // Populate the pivot table
        echo " Insert: posts \n\n";
        $posts = $this->createSamplePosts();
        foreach($posts as $post) {
            $categoryId = rand(1, $numOfCategories);
            $cat = $categories[$categoryId - 1];
            $categoryName = $cat['name'];
            $post['category_id'] = $categoryId;
            $post['category_name'] = $categoryName;
            $post['created_by'] = 1;
            $post['updated_by'] = 1;
            $post['featured_image'] = 'https://picsum.photos/1200/630';
            $now = date('Y-m-d H:i:s');
            $post['published_at'] = $now;
            $post['reward_type'] = 'NTF';
            $post['block_chain_network'] = 'PHALA';
            $post['total_token'] = 10000;
            $post['total_person'] = 5;

            //Start At
            $post['start_at'] = $now;
            //End At
            $post['end_at'] = date('Y-m-d H:i:s', strtotime($now . ' + 1 month'));

            $postModel = Post::create($post);

            //Create Task Post
            $tasks = $this->createSampleTasks();
            foreach ($tasks as $taskItem){
                $taskItem['post_id'] = $postModel->id;
                $taskItem['created_by'] = 1;
                $taskItem['updated_by'] = 1;
                Task::create($taskItem);
            }
        }

        $this->call([
            CommentDatabaseSeeder::class
        ]);

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }

    private function createSamplePosts() {
        return [
            ['name' => 'The Blueberry Nebula',  'intro' => 'Introduction of The Blueberry Nebula', 'content' => 'Content of The Blueberry Nebula', 'hits' => '0',  'status' => 'Active'],
            ['name' => 'Particle Network and Scroll Sepolia Campaign',  'intro' => 'Introduction of Particle Network and Scroll Sepolia Campaign', 'content' => 'Content of Particle Network and Scroll Sepolia Campaign', 'hits' => '0',  'status' => 'Active'],
            ['name' => 'DerpDEX is now on opBNB! 🚀',  'intro' => 'Introduction of DerpDEX is now on opBNB! 🚀', 'content' => 'Content of DerpDEX is now on opBNB! 🚀', 'hits' => '0',  'status' => 'Active'],
            ['name' => 'Black Panther Mainnet Launch',  'intro' => 'Introduction of Black Panther Mainnet Launch', 'content' => 'Content of Black Panther Mainnet Launch', 'hits' => '0',  'status' => 'Active'],
            ['name' => 'AltLayer Altitude Phase IV: Autonomous Worlds',  'intro' => 'Introduction of AltLayer Altitude Phase IV: Autonomous Worlds', 'content' => 'Content of AltLayer Altitude Phase IV: Autonomous Worlds', 'hits' => '0',  'status' => 'Active'],
            ['name' => 'Pulsar in the Distance',  'intro' => 'Introduction of Pulsar in the Distance', 'content' => 'Content of Pulsar in the Distance', 'hits' => '0',  'status' => 'Active'],
            ['name' => 'SecondLive x Scroll Sepolia – Onboard a Gift Unlocking Journey',  'intro' => 'Introduction of SecondLive x Scroll Sepolia – Onboard a Gift Unlocking Journey', 'content' => 'Content of SecondLive x Scroll Sepolia – Onboard a Gift Unlocking Journey', 'hits' => '0',  'status' => 'Active'],
            ['name' => 'Catalyst Research Supporter',  'intro' => 'Introduction of Catalyst Research Supporter', 'content' => 'Content of Catalyst Research Supporter', 'hits' => '0',  'status' => 'Active'],
            ['name' => 'Airdrop for Galxe Campaign Supporters ',  'intro' => 'Introduction of Airdrop for Galxe Campaign Supporters ', 'content' => 'Content of Airdrop for Galxe Campaign Supporters ', 'hits' => '0',  'status' => 'Active'],
            ['name' => 'Scroll Sepolia Testnet Galxe Campaign',  'intro' => 'Introduction of Scroll Sepolia Testnet Galxe Campaign', 'content' => 'Content of Scroll Sepolia Testnet Galxe Campaign', 'hits' => '0',  'status' => 'Active'],
            ['name' => 'Lynx Testnet - Base &amp; Mantle',  'intro' => 'Introduction of Lynx Testnet - Base &amp; Mantle', 'content' => 'Content of Lynx Testnet - Base &amp; Mantle', 'hits' => '0',  'status' => 'Active'],
            ['name' => 'Particle Network and COMBO Network Campaign',  'intro' => 'Introduction of Particle Network and COMBO Network Campaign', 'content' => 'Content of Particle Network and COMBO Network Campaign', 'hits' => '0',  'status' => 'Active'],
            ['name' => 'RedStone ✖️ Scroll Sepolia Testnet Campaign ',  'intro' => 'Introduction of RedStone ✖️ Scroll Sepolia Testnet Campaign ', 'content' => 'Content of RedStone ✖️ Scroll Sepolia Testnet Campaign ', 'hits' => '0',  'status' => 'Active'],
            ['name' => '1 Million $PPT Airdrop! Mint opBNB Pop Pilot Pass',  'intro' => 'Introduction of 1 Million $PPT Airdrop! Mint opBNB Pop Pilot Pass', 'content' => 'Content of 1 Million $PPT Airdrop! Mint opBNB Pop Pilot Pass', 'hits' => '0',  'status' => 'Active'],
            ['name' => 'Catalyst Missions Launch Supporter',  'intro' => 'Introduction of Catalyst Missions Launch Supporter', 'content' => 'Content of Catalyst Missions Launch Supporter', 'hits' => '0',  'status' => 'Active'],
            ['name' => 'Join zkLink Insights and win 10 loyalty points!',  'intro' => 'Introduction of Join zkLink Insights and win 10 loyalty points!', 'content' => 'Content of Join zkLink Insights and win 10 loyalty points!', 'hits' => '0',  'status' => 'Active'],
            ['name' => '🎁Earn Your Metaverse Passport: SecondLive on Scroll Sepolia',  'intro' => 'Introduction of 🎁Earn Your Metaverse Passport: SecondLive on Scroll Sepolia', 'content' => 'Content of 🎁Earn Your Metaverse Passport: SecondLive on Scroll Sepolia', 'hits' => '0',  'status' => 'Active']
        ];
    }

    private function createSampleCategories() {
        return [
            ['name' => 'OAT', 'slug' => 'oat',  'description' => 'Description of OAT'],
            ['name' => 'NFT', 'slug' => 'nft',  'description' => 'Description of NFT'],
            ['name' => 'Custom Reward', 'slug' => 'custom-reward',  'description' => 'Description of Custom Reward'],
            ['name' => 'Token Reward', 'slug' => 'token-reward',  'description' => 'Description of Token Reward'],
            ['name' => 'Discord Role', 'slug' => 'discord-role',  'description' => 'Description of Discord Role'],
            ['name' => 'Point', 'slug' => 'point',  'description' => 'Description of Point'],
            ['name' => 'Mintlist', 'slug' => 'mintlist',  'description' => 'Description of Mintlist']
        ];
    }

    private function createSampleTags() {
        return [
            ['name' => '50Point',  'slug' => uniqid(), 'status' => 'Active'],
            ['name' => '100Point',  'slug' => uniqid(), 'status' => 'Active'],
            ['name' => '150Point',  'slug' => uniqid(), 'status' => 'Active'],
            ['name' => '200Point',  'slug' => uniqid(), 'status' => 'Active'],
            ['name' => '250Point',  'slug' => uniqid(), 'status' => 'Active'],
            ['name' => '300Point',  'slug' => uniqid(), 'status' => 'Active'],
            ['name' => '350Point',  'slug' => uniqid(), 'status' => 'Active'],
            ['name' => '400Point',  'slug' => uniqid(), 'status' => 'Active'],
            ['name' => '50USDT',  'slug' => uniqid(), 'status' => 'Active'],
            ['name' => '100USDT',  'slug' => uniqid(), 'status' => 'Active'],
            ['name' => '150USDT',  'slug' => uniqid(), 'status' => 'Active'],
            ['name' => '200USDT',  'slug' => uniqid(), 'status' => 'Active'],
            ['name' => '250USDT',  'slug' => uniqid(), 'status' => 'Active'],
            ['name' => '300USDT',  'slug' => uniqid(), 'status' => 'Active'],
            ['name' => '350USDT',  'slug' => uniqid(), 'status' => 'Active'],
            ['name' => '400USDT',  'slug' => uniqid(), 'status' => 'Active'],

        ];
    }
    //Create Sample Task
    private function createSampleTasks()
    {
        return [
            [
                'name' => 'Follow @BreederDodo on Twitter',
                'description' => 'Follow @BreederDodo on Twitter',
                'value' => 'https://twitter.com/intent/follow?screen_name=BreederDodo',
                'slug' => uniqid(),
                'entry_type' => Task::TYPE_TWITTER_FOLLOW,
                'status' => Task::STATUS_ACTIVE
            ],

            [
                'name' => 'Like @DerpDEXcom Tweet',
                'description' => 'DerpDEXcom’s Tweet likers',
                'value' => 'https://twitter.com/intent/like?tweet_id=1708779829368357330',
                'slug' => uniqid(),
                'entry_type' => Task::TYPE_TWITTER_LIKE,
                'status' => Task::STATUS_ACTIVE
            ],
            [
                'name' => 'Retweet the Tweet',
                'description' => 'DerpDEXcom’s Tweet retweeters',
                'value' => 'https://twitter.com/intent/retweet?tweet_id=1708779829368357330',
                'slug' => uniqid(),
                'entry_type' => Task::TYPE_TWITTER_RETWEET,
                'status' => Task::STATUS_ACTIVE
            ],
            [
                'name' => 'Tweet Quoters & Mention 3 friends ',
                'description' => 'omni_hub’s Tweet quoters who also hashtagged #OmniHub, #Airdrop and mentioned at least 3 friends.',
                'value' => 'https://twitter.com/intent/tweet?text=%23OmniHub %23Airdrop https://twitter.com/omni_hub/status/1717151082013393010',
                'slug' => uniqid(),
                'entry_type' => Task::TYPE_TWITTER_QUOTE,
                'status' => Task::STATUS_ACTIVE
            ],

            //Twitter Hashtag
            [
                'name' => 'Tweet with Hashtag',
                'description' => 'Tweet with Hashtag',
                'value' => 'https://twitter.com/intent/tweet?text=%23OmniHub %23Airdrop https://twitter.com/omni_hub/status/1717151082013393010',
                'slug' => uniqid(),
                'entry_type' => Task::TYPE_TWITTER_HASHTAG,
                'status' => Task::STATUS_ACTIVE
            ],
            //Telegram Join
            [
                'name' => 'Join Telegram',
                'description' => 'Join Telegram',
                'value' => 'https://t.me/derpdex',
                'slug' => uniqid(),
                'entry_type' => Task::TYPE_TELEGRAM_JOIN,
                'status' => Task::STATUS_ACTIVE
            ],

            //Discord Join
            [
                'name' => 'Join Discord',
                'description' => 'Join Discord',
                'value' => 'https://discord.gg/derpdex',
                'slug' => uniqid(),
                'entry_type' => Task::TYPE_DISCORD_JOIN,
                'status' => Task::STATUS_ACTIVE
            ],

            //NFT Check
            [
                'name' => 'Check NFT',
                'description' => 'Check NFT',
                'value' => 'https://opensea.io/collection/derpdex',
                'slug' => uniqid(),
                'entry_type' => Task::NFT_TYPE,
                'status' => Task::STATUS_ACTIVE
            ],

            //Social Referal
            [
                'name' => 'Social Referal',
                'description' => 'Social Referal',
                'value' => 'https://x.com',
                'slug' => uniqid(),
                'entry_type' => Task::TASK_SOCIAL,
                'status' => Task::STATUS_ACTIVE
            ],

            //Telegram https://t.me/derpdex

        ];
    }

}
