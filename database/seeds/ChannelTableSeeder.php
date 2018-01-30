<?php

use App\Channel;
use Illuminate\Database\Seeder;

class ChannelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        channel::create([
            'title' => 'Laravel 5',
            'slug'  => str_slug('Laravel 5')
        ]);
        channel::create([
            'title' => 'Codeigniter 3', 
            'slug'  => str_slug('Codeigniter 3')
        ]);
        channel::create([
            'title' => 'Wordpress',
            'slug' => str_slug('Wordpress')]);
        channel::create([
            'title' => 'Vue JS',           
            'slug'  => str_slug('Vue JS')]);
        channel::create([
            'title' => 'React JS',         
            'slug'  => str_slug('React JS')]);
        channel::create([
            'title' => 'Angular JS',
            'slug'  => str_slug('Angular JS')]);
        channel::create([
            'title' => 'Spark',            
            'slug'  => str_slug('Spark')
        ]);
        channel::create([
            'title' => 'Lumen',
            'slug'  => str_slug('Lumen')
        ]);
    }
}
