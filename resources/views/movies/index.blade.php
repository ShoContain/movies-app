@extends('layouts.main')


@section('content')
   <div class="container mx-auto px-4 pt-16">
       <div class="popular-movies border-b  pb-10 border-gray-400">
           <h2 class="text-orange-400 tracking-wider font-semibold">人気の映画</h2>
           <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-16">

               @foreach($popularMovies as $movie)
                 <x-movie-card :movie="$movie" :genres="$genres"/>
               @endforeach
           </div>
       </div> {{--end of pupular-movies--}}

        <div class="now-playing-movies pt-20">
           <h2 class="text-orange-400 tracking-wider font-semibold">上映中の映画</h2>
           <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-16">
               @foreach($nowPlayingMovies as $movie)
                   <x-movie-card :movie="$movie" :genres="$genres"/>
               @endforeach
           </div>
       </div>   {{--end-of-now-playing-movies--}}
   </div>
@endsection
