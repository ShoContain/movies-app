<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $genres;
    public $nowPlayingMovies;

    public function __construct($popularMovies,$genres,$nowPlayingMovies)
    {
        $this->popularMovies=$popularMovies;
        $this->genres=$genres;
        $this->nowPlayingMovies=$nowPlayingMovies;
    }

    public function popularMovies(){

        return $this->movieFormat($this->popularMovies);
    }

    public function nowPlayingMovies(){
        return $this->movieFormat($this->nowPlayingMovies);
    }

    public function genres(){
            return collect($this->genres)->mapWithKeys(function($genres){
            return [$genres['id']=>$genres['name']];
        });
    }


//@foreach($movie['genre_ids'] as $genre_id) {{ $genres->get($genre_id) }} @if(!$loop->last)
//                       ,
//                    @endif   @endforeach
    private function movieFormat($movies){

        return collect($movies)->map(function($movie){
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value){
                return [$value=>$this->genres()->get($value)];
            })->implode(' , ');

            return collect($movie)->merge([
                'poster_path'=>$movie['poster_path']
                    ? 'https://image.tmdb.org/t/p/w500'.$movie['poster_path']
                    :null,
                'release_date'=> Carbon::parse( $movie['release_date'])->format('Y年m月d日'),
                'genres'=>$genresFormatted,
            ])->only([
                'poster_path','release_date','genres','vote_average','title','id'
            ]);
        });
    }
}
