<?php

namespace App\ViewModels;

use Carbon\Carbon;
use ReflectionMethod;
use Spatie\ViewModels\ViewModel;

class ShowMovieModel extends ViewModel
{
    public $movie;
    public $video;
    public $images;

    public function __construct($movie,$video,$images)
    {
        $this->movie=$movie;
        $this->video=$video;
        $this->images=$images;
    }

    public function movie()
    {
        return collect($this->movie)->merge([
            'poster_path'=>$this->movie['poster_path']
                ?'https://image.tmdb.org/t/p/w500'.$this->movie['poster_path']
                :'',
            'release_date'=> Carbon::parse( $this->movie['release_date'])->format('Y年m月d日'),
            'genres'=>collect($this->movie['genres'])->pluck('name')->flatten()->implode(' , '),
            'cast'=>collect($this->movie['credits']['cast'])->take(2),
        ]);
    }

    public function images(){
        return collect($this->images)->merge([
            'images'=>collect($this->images['backdrops'])->take(9),
        ]);
    }
}
