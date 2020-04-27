<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorDetailModel extends ViewModel
{
    public $detailActor;
    public $social;
    public $credits;

    public function __construct($detailActor,$social,$credits)
    {
        $this->detailActor = $detailActor;
        $this->social = $social;
        $this->credits = $credits;
    }

    public function social(){
        return collect($this->social)->merge([
            'twitter'=>$this->social['twitter_id']?"https://twitter.com/".$this->social['twitter_id']:null,
            'facebook'=>$this->social['facebook_id']?"https://facebook.com/".$this->social['facebook_id']:null,
            'instagram'=>$this->social['instagram_id']?"https://instagram.com/".$this->social['instagram_id']:null,
        ]);
    }

    public function knownForMovies(){
        $castMovies = collect($this->credits)->get('cast');
        return collect($castMovies)->sortByDesc('popularity')->take(5)
            ->map(function($movie){
            if(isset($movie['title'])){
                $title=$movie['title'];
            }elseif(isset($movie['name'])){
                $title = $movie['name'];
            }else{
                $title='タイトルが見つかりません';
            }
            return collect($movie)->merge([
                'poster_path'=>$movie['poster_path']
                ? 'https://image.tmdb.org/t/p/w185'.$movie['poster_path']
                : 'https://via.placeholder.com/185x278',
                'title'=>$title,
                'linkToPage'=>$movie['media_type']=='movie'
                    ?route('movies.show',$movie['id'])
                    :route('tv.show',$movie['id']),
            ]);
        });
    }

    public function credits(){
        $credits = collect($this->credits)->get('cast');
        return collect($credits)->map(function($movie){

            if (isset($movie['release_date'])){
                $releaseDate = $movie['release_date'];
            }elseif (isset($movie['first_air_date'])){
                $releaseDate = $movie['first_air_date'];
            }else{
                $releaseDate = ' ';
            }

            if(isset($movie['title'])){
                $title=$movie['title'];
            }elseif ($movie['name']){
                $title = $movie['name'];
            }else{
                $title = '';
            }

            return collect($movie)->merge([
                'release_date'=>$releaseDate,
                'release_year'=>isset($releaseDate)
                    ?Carbon::parse($releaseDate)->format('Y年')
                    :'',
                'title'=>$title,
                'linkToPage'=>$movie['media_type']=='movie'
                    ?route('movies.show',$movie['id'])
                    :route('tv.show',$movie['id']),
                'character'=>isset($movie['character'])
                    ? $movie['character']:' ',
            ]);
        })->sortByDesc('release_date')->dump();
    }

    public function detailActor(){
        return collect($this->detailActor)->merge([
            'place_of_birth'=>$this->detailActor['place_of_birth']
                ?$this->placeOfBirth($this->detailActor['place_of_birth'])
                :null,
            'birthday'=>$this->detailActor['birthday']
                ?$this->dateFormatted($this->detailActor['birthday'])
                :null,
            'deathage'=>$this->detailActor['deathday']
                ?' 享年 '.$this->passedAge($this->detailActor['birthday'],$this->detailActor['deathday']).'歳'
                :null,
            'age'=>$this->detailActor['deathday']
                ?null
                :$this->age($this->detailActor['birthday']).'歳',
            'profile_path'=>$this->detailActor['profile_path']
                ?'https://image.tmdb.org/t/p/w300'.$this->detailActor['profile_path']
                :'https://ui-avatars.com/api/?size=235&name'.$this->detailActor['name'],
        ]);
    }


    private function dateFormatted($date){
        return Carbon::parse($date)->format('Y年n月d日');
    }

    private function age($date){
        return Carbon::parse($date)->age;
    }

    private function passedAge($birthday,$deathday){
        $birthyear = Carbon::parse($birthday)->year;
        $deathyear = Carbon::parse($deathday)->year;
        return $deathyear-$birthyear;
    }

    private function placeOfBirth($place){
        $place = explode(',',trim($place));
        krsort($place);
        return implode(',',$place);
    }
}
