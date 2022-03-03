<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Post;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'desc')->paginate(10);
        
        return view('admin.categories.index', ['categories'=> $categories]);
    }

    public function show(Category $category) 
    {
        return view('admin.categories.show', ['category' => $category]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  @dd($request);
        $data = $request->all();
        $validateData = $request->validate ([
            'name'=> 'required|max:255'
        ]);
        
        $slug = Str::slug($data['name'], '-'); // creo variabile slug che viene formata dal titolo diviso da '-' 
        $categoryPr = Category::where('slug', $slug)->first(); // la variabile è costituita da una chiamata post dove 'slug' è uguale a $slug->first() 
        // ovvero la prima chiamate

        //creo un counter per il ciclo while
        $counter = 0;
        while ($categoryPr) { //se faccio un dd() di $postPresente mi restituirà null se non esiste,
            //di conseguenza giro finche è null

            $slug = $slug . '-' . $counter; // nuovo nome che avrò in caso di doppione

            $categoryPr = Category::where('slug', $slug)->first(); 

            //il conunter ad ogni giro aumenta "++"
            $counter++;
        }


        $category = new Category();
        $category->fill($data);
        $category->slug = $slug;
        $category->save();
        
        return redirect()->route('admin.categories.show', $category);
    }


     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // @dd('ciao');
        return view('admin.categories.create');
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // @dd($category->id);
        // @dd(Post::where('category_id', '==', $category->id)->get());
        $postCategory = Post::where('category_id', '==', $category->id)->get();
        @dd($postCategory);
        foreach ($postCategory as $value) {

            $value->delete();
        }

        $category->delete();
        

        return redirect()->route('admin.categories.index')->with('status', "Category id $category->name deleted");
    }
}
