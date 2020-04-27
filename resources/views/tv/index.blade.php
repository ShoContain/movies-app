@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-tv border-b  pb-10 border-gray-400">
            <h2 class="text-orange-400 tracking-wider font-semibold">有名ドラマ・アニメ</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-16">

                @foreach($popularTv as $tvshow)
                    <x-tv-card :tvshow="$tvshow"/>
                @endforeach
            </div>
        </div> {{--end of pupular-tv--}}

        <div class="top-rated-tv pt-20">
            <h2 class="text-orange-400 tracking-wider font-semibold">高評価ドラマ・アニメ</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-16">
                @foreach($topRatedTv as $tvshow)
                    <x-tv-card :tvshow="$tvshow"/>
                @endforeach
            </div>
        </div>   {{--end-of-top-rated-tv--}}
    </div>
@endsection
