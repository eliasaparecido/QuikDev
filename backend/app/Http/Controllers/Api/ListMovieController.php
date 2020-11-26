<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ListMovieController extends Controller
{

    private $key;

    public function __construct()
    {
        $this->key = env('MOVIE_APP_KEY');
    }

    public function list()
    {
        $response = Http::get('https://api.themoviedb.org/3/trending/movie/week?api_key='.$this->key);
        return $response;
    }

    public function details($id)
    {
        $response = Http::get('https://api.themoviedb.org/3/movie/'.$id.'?api_key='.$this->key.'&language=en-US');
        return $response;
    }

    public function genres()
    {
        $response = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key='.$this->key.'&language=en-US');
        return $response;
    }

    public function searchname(Request $request)
    {
        $response = Http::get('https://api.themoviedb.org/3/search/movie?api_key='.$this->key.'&query='.$request->title);
        return $response;
    }
}
