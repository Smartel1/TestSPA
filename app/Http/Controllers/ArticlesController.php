<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\EditArticleRequest;
use App\Article;

class ArticlesController extends Controller
{

    /**
     * Возвращает JSON-массив статей с коротким телом.
     *
     * @return String
     */
    public function articles(){
        $short_articles = Article::all()->map(function ($article){
            $short_body = substr($article->body, 0, 400);
            $article->body=$short_body;
            return $article;
        });
        return $short_articles->toJson();
    }

    /**
     * Возвращает статью с заданным ID
     *
     * @param Article $article
     * @return String
     */
    public function article(Article $article){
        //инкремент счетчика посещений
        $article->visits_count += 1;
        $article->save();

        return $article->toJson();
    }


    public function create(CreateArticleRequest $request){
        Article::create($request->all());
        return 'success';
    }

    public function edit(Article $article, EditArticleRequest $request){
        $article->update($request->all());
        return 'success';
    }

    public function delete(Article $article){
        try {
            $article->delete();
        } catch (\Exception $e) {
            return 'fail';
        }
        return 'success';
    }
}
