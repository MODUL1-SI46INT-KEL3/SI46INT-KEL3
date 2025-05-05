<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;


class AdminArticleController extends Controller
{   
    public function search(Request $request)
{
    $query = $request->input('query');

    $results = Article::where('header', 'like', "%{$query}%")
        ->orWhere('created_at', 'like', "%{$query}%")
        ->orWhere('description', 'like', "%{$query}%")
        ->orWhere('author', 'like', "%{$query}%")
        ->get();

    return view('articles.search', compact('results', 'query'));
}
    public function index()
    {
        $articles = article::all(); 
        $nav = 'articles';
        return view('admins.adminarticle.index', compact('articles', 'nav')); 
    }

    public function generalIndex()
    {
        $articles = article::all(); 
        $nav = 'articles';
        return view('articles.index', compact('articles', 'nav')); 
    }

    public function create() 
    {
        $nav = 'Create Article';
        return view('admins.adminarticle.create', compact('nav')); 
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'header' => 'required|string',
            'description' => 'required|string',
            'author' => 'required|string',
            'img_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'img_link' => 'nullable|url'
        ]);
        
        if ($request->hasFile('img_file')) {
            // Store uploaded file
            $imagePath = $request->file('img_file')->store('images', 'public');
        } elseif ($request->filled('img_link')) {
            // Use image URL as-is
            $imagePath = $request->input('img_link');
        }

        article::create(
            [
                'header' => $validateData['header'],
                'description' => $validateData['description'],
                'author' => $validateData['author'],
                'img' => $imagePath
            ]
        );
        return redirect()->route('adminarticle.index')->with('success', 'article has been added.');
    }

    public function show(string $id)
    {
        $article = article::findOrFail($id);
        $nav = 'article Details - ' . $article->medicine_name;
        return view('adminarticle.show', compact('article', 'nav'));
    }

    public function edit(string $id)
    {
        $article = article::findOrFail($id);
        $nav = 'Edit article - ' . $article->medicine_name;
        return view('admins.adminarticle.edit', compact('article', 'nav'));
    }

    public function update(Request $request, string $id)
    {
        $article = article::findOrFail($id);
        $validateData = $request->validate([
            'header' => 'required|string',
            'description' => 'required|string',
            'author' => 'required|string',
            'img_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'img_link' => 'nullable|url'
        ]);

        if ($request->hasFile('img_file')) {
            // Store uploaded file
            $imagePath = $request->file('img_file')->store('images', 'public');
        } elseif ($request->filled('img_link')) {
            // Use image URL as-is
            $imagePath = $request->input('img_link');
        }

        $article->update([
            'header' => $validateData['header'],
            'description' => $validateData['description'],
            'author' => $validateData['author'],
            'img' => $imagePath
        ]);
        return redirect()->route('adminarticle.index')->with('success', 'article updated successfully.');
    }

    public function destroy(string $id)
    {
        $article = article::findOrFail($id);
        $article->delete();
        return redirect()->route('adminarticle.index')->with('success', 'article has been deleted.');
    }
    
    // public function medicine_export()
    // {
    //     $articles = article::all();
    //     $nav = 'articles List';
    //     $pdf = PDF::loadView('admins.adminarticle.pdf', compact('articles', 'nav'));
    //     return $pdf->download('articles.pdf');
    // }
    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
