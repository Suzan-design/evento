<?php
namespace App\Traits;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;

trait FileStorageTrait {


    public function storefile(UploadedFile $file, string $path): ?string {
        try{
            // Ensure the file is an file
            if (!$file->isValid() ) {
                throw new \Exception('Invalid file');
            }

            // Store the file and return the path
            return $file->store($path, 'public');
        } catch (\Exception $e) {
            // Handle exceptions (log, notify, etc.)
            \Log::error('file Storage Error: ' . $e->getMessage());
            return null;
        }
    }

    protected function handleFiles($files, $folder)
{
    $paths = [];
    foreach ($files as $file) {
        if (in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
            // Compress and resize images
            $originalSize = $file->getSize(); // Debugging: Original size
            $image = Image::make($file)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('jpg', 50);  // Adjust quality as needed

            $tempPath = $file->hashName();
            $image->save(storage_path('app/public/' . $folder . '/' . $tempPath));

            $compressedSize = filesize(storage_path('app/public/' . $folder . '/' . $tempPath)); // Debugging: Compressed size
            $compressedFile = new UploadedFile(
                storage_path('app/public/' . $folder . '/' . $tempPath),
                $file->getClientOriginalName(),
                'image/jpeg',
                null,
                true // Marking file as test
            );

            $paths[] = $this->storefile($compressedFile, $folder);
            unlink(storage_path('app/public/' . $folder . '/' . $tempPath)); // Clean up temporary file
        } else if (in_array($file->getMimeType(), ['video/mp4', 'video/quicktime'])) {
            // Store video files first
            $storedPath = $this->storefile($file, $folder);
            // Process video for HLS
            $hlsUrl = $this->processVideoForHLS($storedPath, $folder);
            $paths[] = $hlsUrl;
        } else {
            // Handle other file types normally
            $paths[] = $this->storefile($file, $folder);
        }
    }
    return $paths;
}


}