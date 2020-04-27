<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTv;
    public $topRatedTv;
    public $genres;

    public function __construct($popularTv,$genres,$topRatedTv)
    {
        $this->popularTv = $popularTv;
        $this->genres = $genres;
        $this->topRatedTv=$topRatedTv;
    }
    public function popularTv(){

        return $this->TvFormat($this->popularTv);
    }

    public function topRatedTv(){
        return $this->TvFormat($this->topRatedTv);
    }

    public function genres(){
        return collect($this->genres)->mapWithKeys(function($genres){
            return [$genres['id']=>$genres['name']];
        });
    }

    private function TvFormat($tv){

        return collect($tv)->map(function($tvShow){
            $genresFormatted = collect($tvShow['genre_ids'])->mapWithKeys(function($value){
                return [$value=>$this->genres()->get($value)];
            })->implode(' , ');

            return collect($tvShow)->merge([
                'poster_path'=>$tvShow['poster_path']
                    ? 'https://image.tmdb.org/t/p/w500'.$tvShow['poster_path']
                    :null,
                'first_air_date'=> Carbon::parse( $tvShow['first_air_date'])->format('Y年n月d日'),
                'genres'=>$genresFormatted,
            ])->only([
                'poster_path','first_air_date','genres','vote_average','name','id'
            ]);
        })->dump();
}
}
