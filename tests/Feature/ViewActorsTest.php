<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ViewActorsTest extends TestCase
{
    /** @test */
    public function the_index_shows_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/person/popular?page=1' => $this->fakePopularActors(),
        ]);
        $response = $this->get(route('actors.index'));
        $response->assertSuccessful();
        $response->assertSee('今注目の俳優');
    }

    private function fakePopularActors()
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 18.03,
                    "known_for_department" => "Acting",
                    "gender" => 2,
                    "id" => 2888,
                    "profile_path" => "/eze9FO9VuryXLP0aF2cRqPCcibN.jpg",
                    "adult" => false,
                    "known_for" => [
                        [
                            "title" => "Independence Day",
                            "id" => "602",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "Suicide Squad",
                            "id" => "297761",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "I am Legend",
                            "id" => "6479",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                    ],
                    "name" => "Will Smith",
                ],
                [
                    "popularity" => 18.491,
                    "known_for_department" => "Acting",
                    "gender" => 2,
                    "id" => 3223,
                    "profile_path" => "/5qHNjhtjMD4YWH3UP0rm4tKwxCL.jpg",
                    "adult" => false,
                    "known_for" => [
                        [
                            "title" => "The Avengers",
                            "id" => "24428",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "Iron Man",
                            "id" => "1726",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "Avengers: Infinity War",
                            "id" => "299536",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                    ],
                    "name" => "Robert Downey Jr.",
                ],
            ]
        ], 200);
    }
}
