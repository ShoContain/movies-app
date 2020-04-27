<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tvshow;
    public $details;

    public function __construct($tvshow,$details)
    {
        $this->tvshow=$tvshow;
        $this->details=$details;

    }

    public function tvshow()
    {
        return collect($this->tvshow)->merge([
            'poster_path'=>$this->tvshow['poster_path']
                ?'https://image.tmdb.org/t/p/w500'.$this->tvshow['poster_path']
                :'',
            'first_air_date'=> Carbon::parse( $this->tvshow['first_air_date'])->format('Y年m月d日'),
            'genres'=>collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(' , '),
            'crew'=>collect($this->details['credits']['crew'])->take(2),
            'cast'=>collect($this->details['credits']['cast'])->map(function ($cast){
                return collect($cast)->merge([
                    'profile_path'=>$cast['profile_path']
                    ? "https://image.tmdb.org/t/p/w300".$cast['profile_path']
                    :"https://via.placeholder.com/300x450",
                ]);
            })->toArray(),
            'video'=>$this->details['videos']['results'],
            'images'=>collect($this->details['images']['backdrops'])->take(9),
            'overview'=>$this->tvshow['overview']
                ?$this->tvshow['overview']
                :$this->details['overview'],
        ])->only([
            'poster_path','id','genres','cast','crew','images','vote_average','overview',
            'first_air_date','name','video','created_by'
    ])->dump();
    }

}
