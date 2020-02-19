<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateVideoThumbnail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $video;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $name = \Str::slug($this->video->title, '_');
        $path = "videos/{$name}.png";

        \FFMpeg::fromDisk('public')
            ->open($this->video->path)
            ->getFrameFromSeconds(10)
            ->export()
            ->toDisk('public')
            ->save($path);

        $this->video->update([
            'thumbnail' => $path,
        ]);

        \FFMpeg::cleanupTemporaryFiles();
    }
}
