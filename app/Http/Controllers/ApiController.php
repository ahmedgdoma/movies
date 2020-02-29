<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Movie;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function GetGenres(Request $request){
        try{
            return Genre::paginate(10);
        }catch (\Exception $e){
            return \response('failed to get data', 406);
        }

    }


    public function GetTopRatedMovies(Request $request){
        return $this->getMovies($request, 1);

    }

    public function GetRecentMovies(Request $request){
        return $this->getMovies($request, 2);

    }

    private function getMovies($request, $type){
        try{
            $movies = Movie::whereHas('types', function (Builder $q) use ($type){
                $q->where('type_id', '=', $type);
            });
            $movies = $this->filterMovies($request, $movies);

            $movies = $this->sortMovies($request, $movies);
            $movies = $movies->paginate(10);
            return $movies;
        }catch (\Exception $e){
            return \response('failed to get data', 406);
        }


    }
    private function filterMovies($request, $movies){
        if($request->get('category_id')){
            $genre = $request->get('category_id');
            $movies->whereHas('genres', function (Builder $q) use ($genre){
                $q->where('genre_id', '=', $genre);
            });
        }
        if($request->get('title')){
            $movies->where('title', 'like', '%'. $request->get('title') . '%');
        }
        if($request->get('id')){
            $movies->where('id', '=', $request->get('id'));
        }
        if($request->get('rate')){
            $movies->where('rate', '>=', $request->get('rate'));
        }
        if($request->get('popularity')){
            $movies->where('popularity', '>=', $request->get('popularity'));
        }
        return $movies;
    }
    private function sortMovies($request, $movies){
        foreach ($request->all() as $key => $value){
            if ((is_null($request->get($key)) || empty($request->get($key)))
                && Str::contains($key, '|')){
                $parameter = explode('|', $key);
                $movies->orderby($parameter[0], $parameter[1]);

            }
        }
        return $movies;
    }
}
