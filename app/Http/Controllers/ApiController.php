<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Resources\Article as ArticleResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ArticleResource
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $search = $request->search;
            $articles = Article::query()->orWhere('title','LIKE',"%{$search}%")
                ->orWhere('author','LIKE',"%{$search}%")
                ->orWhere('email','LIKE',"%{$search}%")
                ->orWhere('summary','LIKE',"%{$search}%")
                ->orWhere('body','LIKE',"%{$search}%")
                ->orWhereYear('created_at','=',$search)
                ->orWhereMonth('created_at','=',$search)
                ->orWhereDay('created_at','=',$search)
                ->paginate(15);
        }
        else{
            $articles = Article::paginate(15);
        }

        return new ArticleResource($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return ArticleResource|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'summary' => 'required',
                'body' => 'required',
                'author' => 'required',
                'email' => 'required|email'
            ]
        );

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->getMessageBag()->all()], 500);
        }

        $article = new Article();

        $article->title = $request->title;
        $article->summary = $request->summary;
        $article->body = $request->body;
        $article->author = $request->author;
        $article->email = $request->email;

        $article->save();

        return new ArticleResource($article);
    }

    /**
     * View the specified resource from storage.
     *
     * @param int $id
     * @return ArticleResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if($article = Article::find($id)){
            return new ArticleResource($article);
        }
        else{
            return response()->json(['error' => 'Article not found.'],404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return ArticleResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'summary' => 'required',
                'body' => 'required',
                'author' => 'required',
                'email' => 'required|email'
            ]
        );

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->getMessageBag()->all()], 500);
        }

        if ($article = Article::find($id)) {
            $article->update($request->all());
            return new ArticleResource($article);
        } else {
            return response()->json([
                'message' => 'Article not found.'
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ArticleResource|\Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($article = Article::find($id)) {
            $article->delete();
            return new ArticleResource($article);
        }
        else{
            return response()->json(['error' => 'Article not found.'],404);
        }
    }
}
