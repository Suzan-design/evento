<?php
namespace App\Services\api;

use App\Models\ServiceProvider\ServiceCategory;
use App\Models\ServiceProvider\ServiceProvider;
use App\Models\ServiceProvider\ServiceProviderAlbums;
use App\Models\User\MobileUser;
use App\Traits\FileStorageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceProviderService
{
    use FileStorageTrait ;
    public function becomeServiceProvider($data, $albumsData)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();

            if ($this->shouldBecomeServiceProvider($user)) {
                $this->updateUserType($user);

                $data = $this->prepareData($data);

                $serviceProvider = $this->createServiceProvider($data);

                $this->saveAlbums($serviceProvider, $albumsData);

                DB::commit();

                return [
                    'status' => true,
                    'message' => 'created successfully'
                ];
            } else {
                return [
                    'status' => true,
                    'message' => 'you can\'t be a service provider'
                ];
            }
        } catch (\Throwable $e) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    private function shouldBecomeServiceProvider($user)
    {
        return in_array($user['type'], ['normal', 'private']);
    }

    private function updateUserType($user)
    {
        $user->update(['type' => 'service_provider']);
    }

    private function prepareData($data)
    {
        $preparedData = $data;

        if (request()->hasFile('profile') && request()->file('profile')->isValid()) {
            $preparedData['profile'] = $this->storefile(request()->file('profile'), 'ServiceProviderProfile');
        }

        if (request()->hasFile('cover') && request()->file('cover')->isValid()) {
            $preparedData['cover'] = $this->storefile(request()->file('cover'), 'ServiceProviderCover');
        }

        return $preparedData;
    }

    private function createServiceProvider($data)
    {
        return ServiceProvider::create([
            'user_id' => Auth::id(),
            'name' => $data['name'],
            'name_ar' => $data['name'],
            'bio' => $data['bio'],
            'bio_ar' => $data['bio'],
            'location_work_governorate' => $data['location_work_governorate'],
            'profile' => $data['profile'] ?? null,
            'cover' => $data['cover'] ?? null,
            'description' => $data['description'],
            'description_ar' => $data['description'],
            'category_id' => $data['category_id'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'type' => 'pending',
        ]);
    }

    private function saveAlbums($serviceProvider, $albumsData)
    {
        foreach ($albumsData as $albumData) {
            $album = new ServiceProviderAlbums();
            $album->name = $albumData['name'];
            $album->service_provider_id = $serviceProvider->id;

            if (isset($albumData['imageFiles'])) {
                $album->images = json_encode($this->handleFiles($albumData['imageFiles'], 'OrganizerImages'));
            }

            if (isset($albumData['videoFiles'])) {
                $album->videos = json_encode($this->handleFiles($albumData['videoFiles'], 'OrganizerVideos'));
            }

            $album->save();
        }
    }

    public function getServiceProviderById($id)
    {
        return ServiceProvider::with('albums')->find($id);
    }

    public function getAllServiceCategories()
    {
        return ServiceCategory::all();
    }

    public function getServiceProvidersByCategory($categoryId)
    {
        return ServiceProvider::with(['user:id,first_name,last_name,phone_number', 'albums'])
            ->where('category_id', $categoryId)
            ->get();
    }


}
