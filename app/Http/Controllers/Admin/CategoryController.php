<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;

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
        // @dd('store');
        $data = $request->all();
        $validateData = $request->validate ([
            'name'=> 'required|max:255'
        ]);
        
        
        $category->fill($data);
        $category->save();
        
        return redirect()->route('admin.categories.show',$category);
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
}
