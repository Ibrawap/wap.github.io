<?php

namespace App\Jobs;

use FFMpeg;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateVideoThumbnail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    protected $video;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $video)
    {
        $this->file = $file;
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = "videos/{$this->file->basename}.png";

        FFMpeg::fromDisk('public')
            ->open($this->file->path)
            ->getFrameFromSeconds(10)
            ->export()
            ->toDisk('public')
            ->save($path);

        $this->video->update([
            'thumbnail' => $path,
        ]);

        FFMpeg::cleanupTemporaryFiles();
    }
}
