<?php
namespace App\Services\web;

use App\Models\ServiceProvider\ServiceProvider;
use App\Models\ServiceProvider\ServiceProviderAlbums;
use App\Models\User\MobileUser;
use App\Traits\FileStorageTrait;
use Illuminate\Support\Facades\DB;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;

class ServiceProviderService
{
    use FileStorageTrait;

    public function getAllServiceProviders()
    {
        return ServiceProvider::select('id', 'name' ,'user_id', 'category_id', 'location_work_governorate')->paginate(15);
    }

    public function createServiceProvider($data, $albums)
    {
        // Start transaction
        DB::beginTransaction();

        try {
            $user = MobileUser::find($data['user_id']);

            if($user['type'] == 'normal' || $user['type'] == 'private')
            {
                $user->update([
                    'type' => 'service_provider'
                ]);

                $data['profile'] = $this->storefile($data['profile'], 'ServiceProviderProfileImages');
                $data['cover'] = $this->storefile($data['cover'], 'ServiceProviderProfileImages');
                $data['type'] = 'Approved' ;
                $serviceProvider = ServiceProvider::create($data);

                foreach ($albums as $albumData) {
                    $album = new ServiceProviderAlbums();
                    $album->name = $albumData['name'];
                    $album->service_provider_id = $serviceProvider->id;

                    if (isset($albumData['imageFiles']))
                        $album->images = json_encode($this->handleFiles($albumData['imageFiles'], 'ServiceProviderImages'));

                    if (isset($albumData['videoFiles']))
                        $album->videos = json_encode($this->handleFiles($albumData['videoFiles'], 'ServiceProviderVideos'));

                    $album->save();
                }

                // Commit transaction
                DB::commit();
                return $serviceProvider;

            }else {
                return response()->json([
                    'User' => 'This User Can\'t Be a Service Provider '
                ]);
            }
        } catch (\Throwable $e) {
            // Rollback transaction on error
            DB::rollback();
            throw $e;
        }
    }

    public function updateServiceProvider(ServiceProvider $serviceProvider, $data)
    {
        $serviceProvider->update($data);
    }

    public function deleteServiceProvider(ServiceProvider $serviceProvider)
    {
        DB::beginTransaction();

        try {
            $user = MobileUser::find($serviceProvider->user_id);
            $user->update([
                'type' => 'normal'
            ]);
            $serviceProvider->delete();
            // Commit transaction
            DB::commit();

        }catch (\Throwable $e)
        {
            DB::rollback();
            throw $e;
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
            }else{
            $paths[] = $this->storefile($file, $folder);
            }
        }
        return $paths;
    }
}
