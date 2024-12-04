<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class EcoLearningController extends Controller
{
    //
    public function index(){
        $articles = Article::all();
        return view('ecoLearning', compact('articles'));
    }

    public function detail($id){
        $article = Article::find($id);
        return view('articleDetail', compact('article'));
    }
}
