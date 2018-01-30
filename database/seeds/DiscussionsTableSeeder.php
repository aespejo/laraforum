<?php

use App\Discussion;
use Illuminate\Database\Seeder;

class DiscussionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t1 = "Laravel 5 unit testing";
        $t2 = "Codeigniter 3 unit testing";
        $t3 = "Wordpress plugin installation";
        $t4 = "Laravel & Vue js Crud sample apps";
        $t5 = "React Js error installing redux";
        $t6 = "Angular js unit testing";
        $t7 = "Laravel lumen installation";

        Discussion::create([
        	'user_id' 		=> 1,
        	'channel_id' 	=> 1,
        	'title' 		=> $t1,
        	'slug' 			=> str_slug($t1),
        	'content' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nullam ac tortor vitae purus faucibus ornare suspendisse. Leo integer malesuada nunc vel. Tellus pellentesque eu tincidunt tortor. Aliquam purus sit amet luctus venenatis lectus magna fringilla urna.',
        ]);

        Discussion::create([
        	'user_id' 		=> 1,
        	'channel_id' 	=> 2,
        	'title' 		=> $t2,
        	'slug' 			=> str_slug($t2),
        	'content' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nullam ac tortor vitae purus faucibus ornare suspendisse. Leo integer malesuada nunc vel. Tellus pellentesque eu tincidunt tortor. Aliquam purus sit amet luctus venenatis lectus magna fringilla urna.',
        ]);

        Discussion::create([
        	'user_id' 		=> 1,
        	'channel_id' 	=> 3,
        	'title' 		=> $t3,
        	'slug' 			=> str_slug($t3),
        	'content' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nullam ac tortor vitae purus faucibus ornare suspendisse. Leo integer malesuada nunc vel. Tellus pellentesque eu tincidunt tortor. Aliquam purus sit amet luctus venenatis lectus magna fringilla urna.',
        ]);

        Discussion::create([
        	'user_id' 		=> 2,
        	'channel_id' 	=> 4,
        	'title' 		=> $t4,
        	'slug' 			=> str_slug($t4),
        	'content' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nullam ac tortor vitae purus faucibus ornare suspendisse. Leo integer malesuada nunc vel. Tellus pellentesque eu tincidunt tortor. Aliquam purus sit amet luctus venenatis lectus magna fringilla urna.',
        ]);

        Discussion::create([
        	'user_id' 		=> 2,
        	'channel_id' 	=> 5,
        	'title' 		=> $t5,
        	'slug' 			=> str_slug($t5),
        	'content' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nullam ac tortor vitae purus faucibus ornare suspendisse. Leo integer malesuada nunc vel. Tellus pellentesque eu tincidunt tortor. Aliquam purus sit amet luctus venenatis lectus magna fringilla urna.',
        ]);

        Discussion::create([
        	'user_id' 		=> 2,
        	'channel_id' 	=> 6,
        	'title' 		=> $t6,
        	'slug' 			=> str_slug($t6),
        	'content' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nullam ac tortor vitae purus faucibus ornare suspendisse. Leo integer malesuada nunc vel. Tellus pellentesque eu tincidunt tortor. Aliquam purus sit amet luctus venenatis lectus magna fringilla urna.',
        ]);


        Discussion::create([
        	'user_id' 		=> 2,
        	'channel_id' 	=> 7,
        	'title' 		=> $t7,
        	'slug' 			=> str_slug($t7),
        	'content' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nullam ac tortor vitae purus faucibus ornare suspendisse. Leo integer malesuada nunc vel. Tellus pellentesque eu tincidunt tortor. Aliquam purus sit amet luctus venenatis lectus magna fringilla urna.',
        ]);
    }
}
