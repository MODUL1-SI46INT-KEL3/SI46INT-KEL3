<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminArticle extends Controller
{
    public function index()
    {
        $articles = article::all(); 
        $nav = 'articles';
        return view('admins.adminarticle.index', compact('article', 'nav')); 
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
            'img' => 'required|string',
        ]);

        article::create($validateData);
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
            'img' => 'required|string',
        ]);

        $article->update($validateData);
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
