<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;

use App\Model\Post;
use App\Model\Tag;
use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;
// se non si importa questa stringa con Auth non sarà possibile effettuare il filtro per post utente
// vedi indexUser
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser()
    {
        // @dd('ciao');
        $posts = Post::where('user_id', Auth::user()->id)->paginate(10);
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
        $tags = Tag::all();
        return view('admin.posts.create', ['categories' => $categories , 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          //@dd($request->all());
        $validateData = $request->validate ([
            'title'=> 'required|max:255',
            'content' => 'required',
            'category_id'=> 'exists:App\Model\Category,id', //category id deve corrispondere
            'tags.*' => 'exists:App\Model\Tag,id',// stessa cosa di category
            'image' =>'nullable|image'

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
        
        if(!empty($data['image'])) {
            $img_path= Storage::put('uploads', $data['image']); 
            $data['image'] = $img_path;
        }

        $newPost = new Post();

        $newPost->fill($data);
        $newPost->slug = $slug;
        $newPost->save();

        // se data image non è vuoto data image = a $img_path che sarebbe l'indirizzo della mia immagine

        //se è diverso da empty ** empty controlla se la variabile esiste e se è vuota
        if(!empty($data['tags'])) {
            $newPost->tags()->attach($data['tags']);
        }

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
        //@dd($post);
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
    public function edit(Post $post)
    {
        // @dd('a');
         $categories = Category::all();
         $tags = Tag::all();
         return view('admin.posts.edit', ['post'=> $post, 'categories' => $categories, 'tags' => $tags]);
         
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        //@dd($data);
        // @dd('ciao');
         //  @dd($request->all());
         $validateData = $request->validate ([
            'title'=> 'required|max:255',
            'content' => 'required',
            'category_id'=> 'exists:App\Model\Category,id', //category id deve corrispondere 
            'tags.*' => 'exists:App\Model\Tag,id'
        ]);


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
        
        //$newPost = new Post();

        //$newPost->fill($data);
        //$newPost->slug = $slug;

        $post->update();

        if(!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);   // sync serve a modificare ciò che ho gia (se avessi fatto attch mi avrebbe solo aggiunto qualcosa ma non tolto)  ** 
            //**se non passo niente invece elimino tutto **
        }else {
            $post->tags()->detach();  //** se non ho il data tags faccio un detach e cancello tutto**  
        }
        
        //solito return redirect che porta allo show ['post' => $newPost ...post è $newPost ]
        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', "Post id $post->id deleted");
    }
}
