<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ListMovieController extends Controller
{

    private $key;
    private $url;

    public function __construct()
    {
        $this->key = env('MOVIE_APP_KEY');
        $this->url = 'https://api.themoviedb.org/3/';
    }

    public function list()
    {
        $response = Http::get($this->url.'trending/movie/week?api_key='.$this->key);
        return $response;
    }

    public function listpagination($page)
    {
        $response = Http::get($this->url.'trending/movie/week?api_key='.$this->key.'&page='.$page);
        return $response;
    }

    public function details($id)
    {
        $response = Http::get($this->url.'movie/'.$id.'?api_key='.$this->key.'&language=en-US');
        return $response;
    }

    public function genres()
    {
        $response = Http::get($this->url.'genre/movie/list?api_key='.$this->key.'&language=en-US');
        return $response;
    }

    public function searchname(Request $request)
    {
        $response = Http::get($this->url.'search/movie?api_key='.$this->key.'&query='.$request->title);
        return $response;
    }

    public function searchnamepagination($title, $page)
    {
        $response = Http::get($this->url.'search/movie?api_key='.$this->key.'&query='.$title.'&page='.$page);
        return $response;
    }
}
