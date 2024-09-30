<?php

namespace App\Services\web;

use App\Models\Common\Reel;
use App\Traits\FileStorageTrait;

class ReelService
{
    use FileStorageTrait;

    public function getReels()
    {
        return $reels = Reel::with(['venue', 'organizer', 'event' => function($query){
            $query->withoutGlobalScopes();
        }])->paginate(15);
    }

    public function searchReels($type, $id)
    {
        $columnName = $type . '_id';
        return Reel::where($columnName, $id)->paginate(15);
    }

    public function storeReel($data, $imageFiles, $videoFiles)
    {
        $imagePaths = null;
        $videoPaths = null;

        if ($imageFiles) {
            $imagePaths = $this->handleFiles($imageFiles, 'ReelImages');
        }

        if ($videoFiles) {
            $processedVideoPaths = [];
            foreach ($videoFiles as $videoFile) {
                $storedPath = $this->storefile($videoFile, 'ReelVideo');
                $hlsUrl = $this->processVideoForHLS($storedPath, 'ReelVideo');
                $processedVideoPaths[] = $hlsUrl;
            }
            $videoPaths = $processedVideoPaths;
        }

        if ($imagePaths) {
            $data['images'] = json_encode($imagePaths);
        }
        if ($videoPaths) {
            $data['videos'] = json_encode($videoPaths);
        }
        $reel = Reel::create($data);
        return $reel;
    }


    public function updateReel(Reel $reel, $data)
    {
        $reel->update($data);
    }

    public function deleteReel(Reel $reel)
    {
        $reel->delete();
    }

    

    protected function processVideoForHLS($videoPath, $folder)
    {
        $publicPath = storage_path('app/public/' . $folder);
        $videoNameWithoutExt = basename($videoPath, '.mp4');
        $hlsOutputPath = $publicPath . '/' . $videoNameWithoutExt . '_hls';

        // Ensure the output directory exists
        if (!file_exists($hlsOutputPath)) {
            mkdir($hlsOutputPath, 0777, true);
        }

        // Path to the stored video
        $storedVideoPath = $publicPath . '/' . basename($videoPath);

        // FFmpeg commands for converting video to HLS format at 360p and 720p while maintaining aspect ratio
        $ffmpegCommand360p = "ffmpeg -i {$storedVideoPath} -profile:v baseline -level 3.0 -vf \"scale='min(640,iw):-2'\" -start_number 0 -hls_time 10 -hls_list_size 0 -f hls {$hlsOutputPath}/360p.m3u8";
        $ffmpegCommand720p = "ffmpeg -i {$storedVideoPath} -profile:v baseline -level 3.0 -vf \"scale='min(1280,iw):-2'\" -start_number 0 -hls_time 10 -hls_list_size 0 -f hls {$hlsOutputPath}/720p.m3u8";

        // Execute the commands
        shell_exec($ffmpegCommand360p);
        shell_exec($ffmpegCommand720p);

        // Construct a web-accessible URL pointing to the main playlist file
        // Assuming you have set up a symlink from public/storage to storage/app/public
        // and the $folder variable correctly points to a directory under storage/app/public
        $webAccessibleUrl = "$folder/$videoNameWithoutExt" . "_hls/360p.m3u8";

        // Return the web-accessible URL
        return $webAccessibleUrl;
    }

}