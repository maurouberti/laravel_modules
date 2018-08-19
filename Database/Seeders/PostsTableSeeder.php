<?php

namespace Son\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Son\Blog\Entities\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $Post = new Post;
        $Post->title = "Home";
        $Post->body = "Home us page";
        $Post->save();

        $Post = new Post;
        $Post->title = "About";
        $Post->body = "About us page";
        $Post->save();
        
        $Post = new Post;
        $Post->title = "Home";
        $Post->body = "Home us Body";
        $Post->save();
        
    }
}
