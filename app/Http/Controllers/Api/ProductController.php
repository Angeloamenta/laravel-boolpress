<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Post;


class ProductController extends Controller
{
    public function index() {

        $posts = post::all();
    
        return response()->json(
            [
                'response' => true,
                'results' => ['posts' => $posts],             //Restituisco i dati in formato json
            ]);
    }
}
