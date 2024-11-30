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
}
