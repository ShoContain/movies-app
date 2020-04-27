@extends('layouts.main')

@section('content')
    <div class="movie-detail border-b border-gray-800">
        <div class="container mx-auto px-4 py-8 flex items-center md:flex-row flex-col">
            @if($movie['poster_path'])
                <img src="{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="w-96">
            @else
                <div class="px-32 py-40 border border-gray-800 text-center">
                    <span>No Image</span>
                </div>
            @endif
            <div class="pl-8 md:pl-20 lg:pl-56">
              <h2 class="text-4xl font-semibold">{{ $movie['title'] }}</h2>
                <div class="flex items-center text-gray-400 text-sm">
                    <svg class="w-4 pb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.001 512.001"><path d="M499.92 188.26l-165.839-15.381L268.205 19.91c-4.612-10.711-19.799-10.711-24.411 0l-65.875 152.97L12.08 188.26c-11.612 1.077-16.305 15.52-7.544 23.216l125.126 109.922-36.618 162.476c-2.564 11.376 9.722 20.302 19.749 14.348L256 413.188l143.207 85.034c10.027 5.954 22.314-2.972 19.75-14.348l-36.619-162.476 125.126-109.922c8.761-7.696 4.068-22.139-7.544-23.216z" fill="#ffdc64"/><path d="M268.205 19.91c-4.612-10.711-19.799-10.711-24.411 0l-65.875 152.97L12.08 188.26c-11.612 1.077-16.305 15.52-7.544 23.216l125.126 109.922-36.618 162.476c-2.564 11.376 9.722 20.302 19.749 14.348l31.963-18.979c4.424-182.101 89.034-310.338 156.022-383.697L268.205 19.91z" fill="#ffc850"/></svg>
                    <span class="ml-2 tracking-widest">{{ $movie['vote_average'] }}/10</span>
                    <span class="mx-2">|</span>
                    <span>{{  $movie['release_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>
                            {{ $movie['genres'] }}
                    </span>
                </div>

                <p class="text-gray-300 mt-12">
                    {{ $movie['overview'] }}
                </p>

                <div class="mt-10 border border-dotted rounded border-orange-600 py-4 px-16 relative">
                    <h4 class="font-extrabold px-2 absolute top-0 left-0 border border-gray-800 bg-gray-500 text-gray-800 rounded text-sm">主演・助演</h4>
                    <div class="flex mt-6">
                        @foreach($movie['cast'] as $cast)
                            <div class="pl-4">
                                <div class="text-sm xl:text-gray-200">{{ $cast['character']}}</div>
                                <div class="mt-4">{{$cast['name']}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

            <div x-data="{isOpen:false}">
                @if( count($video['results']) > 0) {{--preview-movie--}}
                   <div class="mt-10">
                       <button class="flex inline-flex items-center bg-orange-600 text-gray-400 rounded font-semibold px-12 py-6 hover:bg-orange-500 tracking-wide"
                               @click="isOpen=true">
                           <svg class="w-8 mr-2"  viewBox="0 0 499.999 499.999"  xmlns="http://www.w3.org/2000/svg"><path d="M171.875 372.237c-2.701 0-5.402-.702-7.812-2.09a15.622 15.622 0 01-7.812-13.535V140.625a15.614 15.614 0 017.797-13.519c4.837-2.792 10.788-2.838 15.625-.015l187.5 107.94c4.837 2.777 7.828 7.95 7.828 13.535s-2.975 10.742-7.828 13.535l-187.5 108.047a15.656 15.656 0 01-7.798 2.089zM187.5 167.648v161.926l140.564-81.009L187.5 167.648z"/><path d="M250 499.999c-137.848 0-250-112.152-250-250S112.152 0 250 0s250 112.152 250 250-112.153 249.999-250 249.999zm0-468.749C129.38 31.25 31.25 129.379 31.25 250S129.379 468.75 250 468.75 468.749 370.62 468.749 250 370.62 31.25 250 31.25z"/></svg>
                           <span>プレビュー</span>
                       </button>
                   </div>

                <div style="background-color:rgba(0,0,0,.5);"
                     class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                     x-show.transition.opacity="isOpen"
                     >

                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end">
                                <button class="text-3xl leading-none hover:text-blue-500" @click="isOpen=false">&times;</button>
                            </div>
                            <div class="modal-body px-8 py-8">
                                <div class="responsive-container overflow-hidden relative" style="padding-top:56.25%">
                                    <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" width="560" height="315"
                                            src="https://www.youtube.com/embed/{{ $video['results'][0]['key'] }}"
                                            allow="autoplay; encrypted-media;" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> {{--preview-movie--}}
                @endif
            </div>

            </div>
        </div>
    </div> {{--end of movie-detail--}}


    <div class="movie-cast border-b border-gray-800">  {{--出演陣セクション start--}}
        <div class="mx-auto container px-4 py-10">
            <h2 class="text-3xl font-semibold text-orange-400">出演陣</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">

                @foreach($movie['credits']['cast'] as $cast)
                    @if($loop->index<5)
                    @if(!empty($cast['profile_path']))
                        <div class="mt-8">
                            <a href="{{route('actors.show',$cast['id'])}}">
                                <img src="{{ 'https://image.tmdb.org/t/p/w500'.$cast['profile_path'] }}"  alt="{{ $cast['name'] }}"
                                     class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                            <div class="mt-2">
                                <a href="{{route('actors.show',$cast['id'])}}" class="text-lg hover:text-gray-400">{{ $cast['name'] }}</a>
                            </div>
                        </div>
                     @else
                        @break
                    @endif
                    @endif
                @endforeach

            </div>
        </div>
    </div>{{--end of movie-cast--}}

    <div class="movie-images border-b border-gray-800"
         x-data="{isOpen:false,image:''}"> {{-- 画像セクション start--}}
        <div class="mx-auto container px-4 py-10">
            <h2 class="text-3xl font-semibold text-orange-400">イメージ</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-16">
                @foreach($images['images'] as $image)
                            <div class="mt-8">
                            <a href="#"
                               @click="isOpen=true
                                      image='{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
                                "
                            >
                                <img src="{{'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}"  alt="image"
                                     class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                        </div>
                @endforeach
            </div>

            <div style="background-color:rgba(0,0,0,.5);"
                 class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                 x-show="isOpen"
            >

                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto" @click.away="isOpen=false">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end">
                            <button class="text-3xl leading-none hover:text-blue-500"
                                    @click="isOpen=false"
                                    @keydown.escape.window="isOpen=false"
                            >
                                &times;
                            </button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>{{--end of movie-images--}}
@endsection
