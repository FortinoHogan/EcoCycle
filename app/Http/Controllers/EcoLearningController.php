<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class EcoLearningController extends Controller
{
    //
    public function index(){
        $searchQuery = request('search');
        $sortOption = request('sort');

        $query = Article::query();

        if ($searchQuery) {
            $query->where('title', 'like', "%{$searchQuery}%");
        }

        switch ($sortOption) {
            case 'alphabetical-ascending':
                $query->orderBy('title', 'asc');
                break;
            case 'alphabetical-descending':
                $query->orderBy('title', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $articles = $query->paginate(5)->appends([
            'search' => $searchQuery,
            'sort' => $sortOption,
        ]);

        return view('ecoLearning', compact('articles', 'searchQuery', 'sortOption'));
    }

    public function detail($id){
        $article = Article::find($id);
        return view('articleDetail', compact('article'));
    }
}
