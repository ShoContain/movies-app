<div class="relative mt-3 md:ml-4 md:mt-0">
    <input wire:model.debounce.500ms="search" "text" class="bg-gray-600 rounded-full w-56 px-4 py-1 pl-10 focus:outline-none focus:shadow-outline text-sm" placeholder="検索">
    <div class="absolute top-0">
        <svg class="fill-current text-gray-800 w-5 mt-1 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129"><path d="M51.6 96.7c11 0 21-3.9 28.8-10.5l35 35c.8.8 1.8 1.2 2.9 1.2s2.1-.4 2.9-1.2c1.6-1.6 1.6-4.2 0-5.8l-35-35c6.5-7.8 10.5-17.9 10.5-28.8 0-24.9-20.2-45.1-45.1-45.1-24.8 0-45.1 20.3-45.1 45.1 0 24.9 20.3 45.1 45.1 45.1zm0-82c20.4 0 36.9 16.6 36.9 36.9C88.5 72 72 88.5 51.6 88.5S14.7 71.9 14.7 51.6c0-20.3 16.6-36.9 36.9-36.9z"/></svg>
    </div>
    <div class="absolute bg-gray-800 rounded w-64 mt-4 text-sm z-20">
       <ul class="">
           @foreach($searchResults as $result)
               @if($loop->iteration<6)
                   <li class="border-b border-gray-700">
                       <a href="{{ route('movies.show',$result['id']) }}" class="block hover:bg-gray-700 px-3 py-2">{{ $result['title'] }}</a>
                   </li>
               @endif
           @endforeach
       </ul>
    </div>
</div>

