<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait FileUploadTrait
{
    public function uploadFile(UploadedFile $file, string $directory, string $name = null)
    {
        $filename = ($name
            ? Str::slug($name, '_')
            : Str::slug(
                pathinfo($file->getClientOriginalName())['filename'], '_'
            )) . "." . $file->getClientOriginalExtension();

        return $file->storeAs($directory, $filename);
    }

    public function remoteUploadFile(string $url, string $directory, string $name = null)
    {
        $tempPath = (ini_get('upload_tmp_dir') ?: sys_get_temp_dir());
        $tempFile = $tempPath . DIRECTORY_SEPARATOR . bin2hex(random_bytes(16));

        file_put_contents($tempFile, file_get_contents($url));

        $file = new UploadedFile($tempFile, basename($url), mime_content_type($tempFile));

        $path = $this->uploadFile($file, $directory, $name);

        unlink($tempFile);

        return $path;
    }
}
