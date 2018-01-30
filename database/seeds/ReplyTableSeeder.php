<?php

use App\Reply;
use Illuminate\Database\Seeder;

class ReplyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   		Reply::create([
   			'user_id' 		=> 1,
   			'discussion_id' => 1,
   			'content' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nullam ac tortor vitae purus faucibus ornare suspendisse. Leo integer malesuada nunc vel. Tellus pellentesque eu tincidunt tortor. Aliquam purus sit amet luctus venenatis lectus magna fringilla urna.'
   		]);

   		Reply::create([
   			'user_id' 		=> 1,
   			'discussion_id' => 2,
   			'content' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nullam ac tortor vitae purus faucibus ornare suspendisse. Leo integer malesuada nunc vel. Tellus pellentesque eu tincidunt tortor. Aliquam purus sit amet luctus venenatis lectus magna fringilla urna.'
   		]);

   		Reply::create([
   			'user_id' 		=> 1,
   			'discussion_id' => 3,
   			'content' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nullam ac tortor vitae purus faucibus ornare suspendisse. Leo integer malesuada nunc vel. Tellus pellentesque eu tincidunt tortor. Aliquam purus sit amet luctus venenatis lectus magna fringilla urna.'
   		]);

   		Reply::create([
   			'user_id' 		=> 2,
   			'discussion_id' => 4,
   			'content' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nullam ac tortor vitae purus faucibus ornare suspendisse. Leo integer malesuada nunc vel. Tellus pellentesque eu tincidunt tortor. Aliquam purus sit amet luctus venenatis lectus magna fringilla urna.'
   		]);

   		Reply::create([
   			'user_id' 		=> 2,
   			'discussion_id' => 5,
   			'content' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nullam ac tortor vitae purus faucibus ornare suspendisse. Leo integer malesuada nunc vel. Tellus pellentesque eu tincidunt tortor. Aliquam purus sit amet luctus venenatis lectus magna fringilla urna.'
   		]);

   		Reply::create([
   			'user_id' 		=> 2,
   			'discussion_id' => 6,
   			'content' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nullam ac tortor vitae purus faucibus ornare suspendisse. Leo integer malesuada nunc vel. Tellus pellentesque eu tincidunt tortor. Aliquam purus sit amet luctus venenatis lectus magna fringilla urna.'
   		]);

   		Reply::create([
   			'user_id' 		=> 2,
   			'discussion_id' => 7,
   			'content' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nullam ac tortor vitae purus faucibus ornare suspendisse. Leo integer malesuada nunc vel. Tellus pellentesque eu tincidunt tortor. Aliquam purus sit amet luctus venenatis lectus magna fringilla urna.'
   		]);
    }
}
