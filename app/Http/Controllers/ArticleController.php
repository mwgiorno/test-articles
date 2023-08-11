<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\CreateRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Models\Article;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('sections')->get();

        return Inertia::render('Article/Index', [
            'articles' => $articles
        ]);
    }

    public function create()
    {
        $sections = Section::all();

        return Inertia::render('Article/Create', [
            'sections' => $sections
        ]);
    }

    public function store(CreateRequest $request)
    {
        $thumbnailPath = $request->file('thumbnail')
            ->store(null, 'thumbnails');
        $thumbnailUrl = Storage::disk('thumbnails')
            ->url($thumbnailPath);

        $article = Article::create([
            'author_id' => $request->user()->id,
            'headline' => $request->headline,
            'slug' => $request->slug,
            'body' => $request->body,
            'thumbnail_path' => $thumbnailPath,
            'thumbnail_url' => $thumbnailUrl,
            'published' => $request->boolean('published')
        ]);

        $article->sections()->attach($request->sections);

        return to_route('articles');
    }

    public function edit(Article $article)
    {
        $sections = Section::all();

        $article->load('sections:id,name');

        $selectedSections = $article->sections->modelKeys();

        return Inertia::render('Article/Edit', [
            'article' => $article,
            'sections' => $sections,
            'selected' => $selectedSections
        ]);
    }

    public function update(Article $article, UpdateRequest $request)
    {
        $request->validate([
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Article::class)->ignore($article->id)
            ]
        ]);

        if($request->hasFile('thumbnail')) {
            Storage::disk('thumbnails')
                ->delete($article->thumbnail_path);

            $article->thumbnail_path = $request->file('thumbnail')
                ->store(null, 'thumbnails');
            
            $article->thumbnail_url = Storage::disk('thumbnails')
                ->url($article->thumbnail_path);
        }

        $article->fill([
            'headline' => $request->headline,
            'slug' => $request->slug,
            'body' => $request->body,
            'published' => $request->boolean('published')
        ]);

        $article->save();

        $article->sections()->sync($request->sections);

        return to_route('articles');
    }
}
