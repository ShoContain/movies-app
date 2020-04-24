<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ViewMovieTest extends TestCase
{
   /** @test */
    public function main_page_shows_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular?language=ja-JA'=>$this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing?language=ja-JA' => $this->fakeNowPlayingMovies(),
            'https://api.themoviedb.org/3/genre/movie/list?language=ja-JA' => $this->fakeGenres(),

        ],200);

        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();
        $response->assertSee('人気の映画');
        $response->assertSee('Fake Movie');

        $response->assertSee('上映中の映画');
        $response->assertSee('Now Playing Fake Movie');

        $response->assertSee('ドラマ , サイエンスフィクション');
        $response->assertDontSee('コメディ');

    }

    public function the_search_drop_down_works_correctly(){
        Http::fake([
            'https://api.themoviedb.org/3/search/movie?query=doraemon'=>$this->fakeSearchMovie(),
        ],200);
        Livewire::test('search-dropdown')
            ->assertDontSee('doraemon')
            ->set('search','doraemon') //searchプロパティーに'doraemon'をセット
            ->assertSee('doraemon');
    }

    private function fakeSearchMovie(){
        return Http::response([
            'results' => [
                [
                    "popularity" => 492.069,
                    "vote_count" => 3023,
                    "video" => false,
                    "poster_path" => "/xJUILftRf6TJxloOgrilOTJfeOn.jpg",
                    "id" => 419704,
                    "adult" => false,
                    "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                    "original_language" => "en",
                    "original_title" => "Fake Movie",
                    "genre_ids" => [
                        18,
                        878,
                    ],
                    "title" => "doraemon",
                    "vote_average" => 6,
                    "overview" => "地球から43億キロ離れた太陽系の彼方で行方不明になった父を巡る謎を解き、人類の危機を救うため、エリート宇宙飛行士が旅立つ",
                    "release_date" => "2019-09-17",
                ]
            ]
        ], 200);

    }

    private function fakePopularMovies()
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 492.069,
                    "vote_count" => 3023,
                    "video" => false,
                    "poster_path" => "/xJUILftRf6TJxloOgrilOTJfeOn.jpg",
                    "id" => 419704,
                    "adult" => false,
                    "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                    "original_language" => "en",
                    "original_title" => "Fake Movie",
                    "genre_ids" => [
                        18,
                        878,
                    ],
                    "title" => "Fake Movie",
                    "vote_average" => 6,
                    "overview" => "地球から43億キロ離れた太陽系の彼方で行方不明になった父を巡る謎を解き、人類の危機を救うため、エリート宇宙飛行士が旅立つ",
                    "release_date" => "2019-09-17",
                ]
            ]
        ], 200);
       }

        private function fakeNowPlayingMovies()
        {
            return Http::response([
                'results' => [
                    [
                        "popularity" => 406.677,
                        "vote_count" => 2607,
                        "video" => false,
                        "poster_path" => "/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg",
                        "id" => 419704,
                        "adult" => false,
                        "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                        "original_language" => "en",
                        "original_title" => "Now Playing Fake Movie",
                        "genre_ids" => [
                            18,
                            878,
                        ],
                        "title" => "Now Playing Fake Movie",
                        "vote_average" => 6,
                        "overview" => "Now playing fake movie description. The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet earth.",
                        "release_date" => "2019-09-17",
                    ]
                ]
            ], 200);
        }

        private function fakeGenres(){
            return Http::response([
                "genres" =>[
               [
                    "id" => 28,
                  "name" => "アクション"
                ],
                    [
                            "id" => 12,
                  "name" => "アドベンチャー"
                ],
                [
                            "id" => 16,
                  "name" => "アニメーション"
                ],
                [
                            "id" => 35,
                  "name" => "コメディ"
                ],
                [
                            "id" => 80,
                  "name" => "犯罪"
                ],
                [
                            "id" => 99,
                  "name" => "ドキュメンタリー"
                ],
                [
                            "id" => 18,
                  "name" => "ドラマ"
                ],
                [
                            "id" => 10751,
                  "name" => "ファミリー"
                ],
                [
                            "id" => 14,
                  "name" => "ファンタジー"
                ],
                [
                            "id" => 36,
                  "name" => "履歴"
                ],
                 [
                            "id" => 27,
                  "name" => "ホラー"
                ],
                 [
                            "id" => 10402,
                  "name" => "音楽"
                ],
                 [
                            "id" => 9648,
                  "name" => "謎"
                ],
                 [
                            "id" => 10749,
                  "name" => "ロマンス"
                ],
                 [
                            "id" => 878,
                  "name" => "サイエンスフィクション"
                ],
                [
                            "id" => 10770,
                  "name" => "テレビ映画"
                ],
                 [
                            "id" => 53,
                  "name" => "スリラー"
                ],
                 [
                            "id" => 10752,
                  "name" => "戦争"
                ],
                 [
                            "id" => 37,
                  "name" => "西洋"
                ],
              ]

            ],200);
        }
}
