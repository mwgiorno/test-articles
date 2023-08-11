<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\SectionResource;
use App\Models\Article;
use App\Models\Section;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::published()
            ->with([
                'sections:id,name', 'author:id,name'
            ])->published()
            ->paginate(15);
        
        return ArticleResource::collection($articles);
    }

    public function get(Article $article)
    {        
        return new ArticleResource($article);
    }

    public function getSections(Article $article)
    {        
        return SectionResource::collection($article->sections);
    }

    public function getBySection(Section $section)
    {
        $articles = $section->articles()
            ->published()
            ->get();

        return ArticleResource::collection($articles);
    }
}
