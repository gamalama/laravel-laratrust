<?php

namespace App\Http\Controllers;

use App\Article;
use App\Traits\FlashAlert;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    use FlashAlert;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(10);
        return view('pages.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string',],
            'published' => ['required'],
        ]);

        request()->user()->articles()->create($request->all());

        return redirect()->route('article.index')->with($this->alertCreated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $article = Article::findOrFail($id);

            return view('pages.article.edit', compact('article'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.user.index')->with($this->alertNotFound());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);

            $this->validate($request, [
                'title' => ['required', 'string', 'max:255'],
                'body' => ['required', 'string',],
                'published' => ['required'],
            ]);

            $article->update($request->all());

            return redirect()->route('article.index')->with($this->alertUpdated());
        } catch (ModelNotFoundException $e) {
            return redirect()->route('article.index')->with($this->alertNotFound());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->delete();

            return redirect()->route('article.index')->with($this->alertDeleted());
        } catch (ModelNotFoundException $e) {
            return redirect()->route('article.index')->with($this->alertNotFound());
        }
    }
}