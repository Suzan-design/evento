<?php
namespace App\Services\api;

use App\Models\User\Organizer;
use App\Models\User\OrganizerAlbum;
use App\Traits\FileStorageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrganizerService
{
    use FileStorageTrait ;
    public function becomeOrganizer($data, $albumsData)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();

            if ($this->shouldBecomeOrganizer($user)) {
                $this->updateUserType($user);

                $data = $this->prepareData($data);

                $organizer = $this->createOrganizer($data);

                $this->attachCategories($organizer, $data['category_ids']);
                $this->saveAlbums($organizer, $albumsData);

                DB::commit();

                return [
                    'status' => true,
                    'message' => 'created successfully'
                ];
            } else {
                return [
                    'status' => true,
                    'message' => 'you can\'t be a organizer'
                ];
            }
        } catch (\Throwable $e) {
            // Rollback the transaction in case of any error
            DB::rollBack();

            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    private function shouldBecomeOrganizer($user)
    {
        return in_array($user['type'], ['normal', 'private']);
    }

    private function updateUserType($user)
    {
        $user->update(['type' => 'organizer']);
    }

    private function prepareData($data)
    {
        $preparedData = $data;

        if (request()->hasFile('profile') && request()->file('profile')->isValid()) {
            $preparedData['profile'] = $this->storefile(request()->file('profile'), 'OrganizerProfile');
        }

        if (request()->hasFile('cover') && request()->file('cover')->isValid()) {
            $preparedData['cover'] = $this->storefile(request()->file('cover'), 'OrganizerCover');
        }

        return $preparedData;
    }

    private function createOrganizer($data)
    {
        return Organizer::create([
            'mobile_user_id' => Auth::guard('mobile')->id(),
            'name' => $data['name'],
            'bio' => $data['bio'],
            'covering_area' => $data['covering_area'],
            'other_category' => $data['other_category'] ?? null,
            'profile' => $data['profile'] ?? null,
            'cover' => $data['cover'] ?? null,
            'type' => 'pending',
        ]);
    }

    private function attachCategories($organizer, $categoryIds)
    {
        $organizer->categories()->attach($categoryIds);
    }

    private function saveAlbums($organizer, $albumsData)
    {
        foreach ($albumsData as $albumData) {
            $album = new OrganizerAlbum();
            $album->name = $albumData['name'];
            $album->organizer_id = $organizer->id;

            if (isset($albumData['imageFiles'])) {
                $album->images = json_encode($this->handleFiles($albumData['imageFiles'], 'OrganizerImages'));
            }

            if (isset($albumData['videoFiles'])) {
                $album->videos = json_encode($this->handleFiles($albumData['videoFiles'], 'OrganizerVideos'));
            }

            $album->save();
        }
    }

    public function getOrganizerFollowers($organizerId)
    {
        $organizer = Organizer::with(['followers:id,first_name,last_name,image'])->find($organizerId);

        return [
            'status' => true,
            'followers' => $organizer->followers ?? [],
        ];
    }

    public function getOrganizerProfile($organizerId)
    {
        $organizer = Organizer::with([
            'organizedEvents:id,title,title_ar,type,start_date,ticket_price,images,venue_id,organizer_id',
            'organizedEvents.venue:id,name,name_ar',
            'albums',
            'categories',
        ])->withCount(['followers', 'organizedEvents'])
            ->find($organizerId);
        $organizer->following_organizers_count = $organizer->mobileUser->followingOrganizersCount();

        if ($organizer) {
            return [
                'status' => true,
                'organizer' => $organizer,
            ];
        } else {
            return [
                'status' => false,
                'error' => 'User not found',
            ];
        }
    }
}
