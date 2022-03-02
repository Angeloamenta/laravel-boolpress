<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;

use App\Model\Post;
use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // passo le categorie nel create  prendendole con Categry ::all()
        $categories = Category::all();
        return view('admin.posts.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // @dd($request->all());
        $validateData = $request->validate ([
            'title'=> 'required|max:255',
            'content' => 'required'
        ]);

        $data = $request->all();

        //parte da rivedere in quanto non perfettamente chiara:
        //slug postpresente e ciclo while prese dalla repo di chiara per comprenderle meglio

        $slug = Str::slug($data['title'], '-'); // creo variabile slug che viene formata dal titolo diviso da '-' 
        $postPresente = Post::where('slug', $slug)->first(); // la variabile è costituita da una chiamata post dove 'slug' è uguale a $slug->first() 
        // ovvero la prima chiamate

        //creo un counter per il ciclo while
        $counter = 0;
        while ($postPresente) { //se faccio un dd() di $postPresente mi restituirà null se non esiste,
            //di conseguenza giro finche è null

            $slug = $slug . '-' . $counter; // nuovo nome che avrò in caso di doppione

            $postPresente = Post::where('slug', $slug)->first(); 

            //il conunter ad ogni giro aumenta "++"
            $counter++;
        }

        $newPost = new Post();

        $newPost->fill($data);
        $newPost->slug = $slug;
        $newPost->save();
        
        //solito return redirect che porta allo show ['post' => $newPost ...post è $newPost ]
        return redirect()->route('admin.posts.show', $newPost->slug);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // @dd($post->slug);
        // $data = [
        //     'post' => $post,
        //     ];
        return view('admin.posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', "Post id $post->id deleted");
    }
}
