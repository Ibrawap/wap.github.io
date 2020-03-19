<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddSongTags implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $song;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($song)
    {
        $this->song = $song;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $getID3 = new \getID3;
        $getID3->setOption(['encoding' => 'UTF-8']);

        $tagwriter           = new \getid3_writetags;
        $tagwriter->filename = \Storage::path($this->song->path);

        //$tagwriter->tagformats = array('id3v1', 'id3v2.3');
        $tagwriter->tagformats = ['id3v2.3'];

        // set various options (optional)
        $tagwriter->overwrite_tags    = true;
        $tagwriter->remove_other_tags = true;
        $tagwriter->tag_encoding      = 'UTF-8';

        // populate data array
        $tagData = [
            'title'   => [$this->song->title . ' | ' . config('app.name')],
            'artist'  => [$this->song->artiste],
            'album'   => [$this->song->album->title ?? config('app.name')],
            'genre'   => [config('app.name')],
            'comment' => ['Downloaded from ' . config('app.name')],
        ];

        $albumArt = public_path('images/album_art.png');
        $imageData = getimagesize($albumArt);

        $tagData['attached_picture'][0]['data']          = file_get_contents($albumArt);
        $tagData['attached_picture'][0]['picturetypeid'] = $imageData[2];
        $tagData['attached_picture'][0]['description']   = basename($albumArt);
        $tagData['attached_picture'][0]['mime']          = $imageData['mime'];

        $tagwriter->tag_data = $tagData;

        // write tags
        if (!$tagwriter->WriteTags()) {
            \Log::error($tagwriter->errors);
        } elseif (!$tagwriter->WriteTags() && !empty($tagwriter->warnings)) {
            \Log::warning($tagwriter->warnings);
        } else {
            session()->flash('success', 'Tags written');
        }
    }
}
