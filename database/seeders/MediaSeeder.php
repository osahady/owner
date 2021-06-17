<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Media\Audio;
use App\Models\Media\Image;
use App\Models\Media\Video;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createImages();
        $this->createVideos();
        $this->createAudios();
    }

    private function createImages()
    {
        for ($i = 1; $i <= 21; $i++) {
            $image = Image::create();
            Media::factory(1)->create([
                'url' => 'https://oceancodeit.com/media/image/image%20(' . $i . ').jpg',
                'mediable_id' => $image->id,
                'mediable_type' => 'image',
            ]);
        }
    }

    private function createVideos()
    {
        for ($i = 1; $i <= 4; $i++) {
            $video = Video::create();
            Media::factory(1)->create([
                'url' => 'https://oceancodeit.com/media/video/video%20(' . $i . ').mkv',
                'mediable_id' => $video->id,
                'mediable_type' => 'video',
            ]);
        }
    }

    private function createAudios()
    {
        for ($i = 1; $i <= 3; $i++) {
            $audio = Audio::create();
            Media::factory(1)->create([
                'url' => 'https://oceancodeit.com/media/audio/audio%20(' . $i . ').m4a',
                'mediable_id' => $audio->id,
                'mediable_type' => 'audio',
            ]);
        }
    }
}
