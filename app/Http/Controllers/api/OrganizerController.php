<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organizer\OrganizerRequest;
use App\Models\User\MobileUser;
use App\Models\User\Organizer;
use App\Models\User\OrganizerAlbum;
use App\Services\api\OrganizerService;
use App\Traits\FileStorageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrganizerController extends Controller
{
    use FileStorageTrait ;
    private $organizerService;

    public function __construct(OrganizerService $organizerService)
    {
        $this->organizerService = $organizerService;
    }
    public function become_organizer(OrganizerRequest $request)
    {
        $data = $request->all() ;
        $albumsData = $this->extractAlbumData($request) ;
        $result = $this->organizerService->becomeOrganizer($data, $albumsData);

        return response()->json($result);
    }


    private function extractAlbumData($request) {
        $albums = [];

        // Assuming each album's data is prefixed with 'album-', like 'album-1-name', 'album-1-images', etc.
        foreach ($request->all() as $key => $value) {
            if (preg_match('/album-\d+-name/', $key)) {
                $albumIndex = explode('-', $key)[1];
                $albumName = $value;
                $imageFiles = $request->file("album-$albumIndex-images");
                $videoFiles = $request->file("album-$albumIndex-videos");

                $albums[] = [
                    'name' => $albumName,
                    'imageFiles' => $imageFiles,
                    'videoFiles' => $videoFiles
                ];
            }
        }

        return $albums;
    }


    public function getOrganizerFollowers($id)
    {
        $result = $this->organizerService->getOrganizerFollowers($id);

        return response()->json($result);
    }

    public function getOrganizerProfile($id)
    {
        $result = $this->organizerService->getOrganizerProfile($id);

        return response()->json($result);
    }

}
