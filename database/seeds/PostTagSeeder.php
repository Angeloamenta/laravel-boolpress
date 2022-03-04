<?php

use App\Model\Post;
use App\Model\Tag;
use Illuminate\Database\Seeder;

class PostTag extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creo una variabile e ci salvo dentro tutti i tag
        $tags= Tag::all();
        //faccio un foreach sulla variabile creata
        //per prendere singolarmente ogni tag

        foreach($tags as $tag) {
        
        //creo una variabile e ci salvo dentro un numero limitato di post con limit(3)
        $posts= Post::inRandomOrder()->limit(3)->get();

        //prendo la variabile creata e con attach collego i post presi prima
        $tag->posts()->attach($posts);

        }
        
    }

}