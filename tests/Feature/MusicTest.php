<?php

namespace App\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Database\Factories\SongFactory;
use Database\Factories\UserFactory;
use Tests\TestCase;
use Storage;

class MusicTest extends TestCase
{

    use RefreshDatabase;

    public function test_can_fetch_all_songs()
    {

        $this->withoutExceptionHandling();

        // perform

        $response = $this->getJson('api/music');

        // predict

        $response->assertStatus(self::HTTP_OK);

    }

    public function test_can_fetch_a_song(){

        $this->withoutExceptionHandling();

        // prepare

        Storage::fake('public');

        $user = UserFactory::new()->create();

        $this->be($user);

        $track = UploadedFile::fake()->create('started from the bottom.mp3', 1500, "mp3");
        $cover = UploadedFile::fake()->image('drake cover.png');

        // perform

        $response = $this->postJson(
            'api/music-upload', ["artist" => "Drake", "title" => "started from the bottom", "genre" => "Hippop", "year" => "2017", "song" => $track, "cover" => $cover,"uploaded_by" => $user->id]
        );

        $content = json_decode($response->getContent());

        $responseGet = $this->getJson("api/music/".$content->data->id);

        // predict

        $responseGet->assertStatus(self::HTTP_OK);

        Storage::fake('reportslocal');

    }


    public function test_can_upload_a_song()
    {

        $this->withoutExceptionHandling();

        // prepare

        Storage::fake('public');

        $user = UserFactory::new()->create();

        $this->be($user);

        
        $track = UploadedFile::fake()->create('started from the bottom.mp3', 1500, "mp3");
        $cover = UploadedFile::fake()->image('drake cover.png');

        // perform

        $response = $this->postJson(
            'api/music-upload', ["artist" => "Drake", "title" => "started from the bottom", "genre" => "Hippop", "year" => "2017", "song" => $track, "cover" => $cover, "uploaded_by" => $user->id]
        );

        $content = json_decode($response->getContent());

        $this->assertObjectHasAttribute('song', $content->data);
        $this->assertObjectHasAttribute('cover', $content->data);

        $uploaded_song_title  = 'music/'.$content->data->song;
        $uploaded_cover_title = 'covers/'.$content->data->cover;

        Storage::disk('public')->assertExists([$uploaded_song_title, $uploaded_cover_title ]);

       
        // predict

        $response->assertStatus(self::HTTP_CREATED);

        Storage::fake('reportslocal');

    }

}
