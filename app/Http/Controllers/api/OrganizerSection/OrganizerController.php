<?php

namespace App\Http\Controllers\api\OrganizerSection;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organizer\OrganizerUpdateRequest;
use App\Models\Event\Booking;
use App\Models\Event\Event;
use App\Models\User\Organizer;
use App\Models\User\OrganizerUpdate;
use App\Models\User\OrganizerUpdateAlbum;
use App\Models\User\OrganizerAlbum;
use App\Services\api\OrganizerService;
use App\Traits\FileStorageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{
    use FileStorageTrait ;

    private $organizerService;

    public function __construct(OrganizerService $organizerService)
    {
        $this->organizerService = $organizerService;
    }

    private function getOrganizerId()
    {
        $user = Auth::user() ;
        return  $user->organizerInfo->id ;

    }
    
    public function updateProfileRequest(OrganizerUpdateRequest $request)
    {
        $data = $request->only('name', 'bio', 'covering_area', 'other_category', 'category_ids');

        if ($request->hasFile('profile') && $request->file('profile')->isValid()) {
            $data['profile'] = $this->storefile($request->file('profile'), 'OrganizerProfile');
        }
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $data['cover'] = $this->storefile($request->file('cover'), 'OrganizerCover');
        }

        $organizer_id = $this->getOrganizerId();
        $data['organizer_id'] = $organizer_id;
        $organizer = Organizer::find($organizer_id);

        if($organizer){
            $organizerUpdate = OrganizerUpdate::create([
            'organizer_id' => $organizer_id,
            'name' => $data['name'],
            'bio' => $data['bio'],
            'covering_area' => $data['covering_area'],
            'other_category' => $data['other_category'] ?? null,
            'profile' => $data['profile'] ?? null,
            'cover' => $data['cover'] ?? null
        ]);
        }

        // Categories handling
        $organizerUpdate->categories()->attach($data['category_ids']);
        $albumsData = $this->extractAlbumData($request) ;
        $this->saveAlbums($organizerUpdate, $albumsData);

        // Conditional albums handling
        //if ($request->has('albums')) {
       //     $this->handleUpdateAlbums($request, $organizerUpdate);
        //}
        return response()->json([
            'status' => true ,
            'message' => 'updated successfully'
        ]);
    }
    private function saveAlbums($organizerUpdate, $albumsData)
    {
        foreach ($albumsData as $albumData) {
            $album = new OrganizerUpdateAlbum();
            $album->name = $albumData['name'];
            $album->organizer_update_id = $organizerUpdate->id;

            if (isset($albumData['imageFiles'])) {
                $album->images = json_encode($this->handleFiles($albumData['imageFiles'], 'OrganizerImages'));
            }

            if (isset($albumData['videoFiles'])) {
                $album->videos = json_encode($this->handleFiles($albumData['videoFiles'], 'OrganizerVideos'));
            }

            $album->save();
        }
    }
    //public function updateProfile(OrganizerUpdateRequest $request)
   // {
   //     $data = $request->only('name', 'bio', 'covering_area', 'other_category', 'category_ids');
//
    //    if ($request->hasFile('profile') && $request->file('profile')->isValid()) {
    //        $data['profile'] = $this->storefile($request->file('profile'), 'OrganizerProfile');
    //    }
     //   if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
     ///       $data['cover'] = $this->storefile($request->file('cover'), 'OrganizerCover');
     //   }
//
     //   $organizer_id = $this->getOrganizerId();
      //  $organizer = Organizer::find($organizer_id);

        // Update Organizer
      //  $organizer->update($data);

        // Categories handling
      //  $organizer->categories()->sync($data['category_ids'] ?? []);

        // Conditional albums handling
      
        //    $this->handleAlbums($request, $organizer);
        
       // return response()->json([
       //     'status' => true ,
       //     'message' => 'updated successfully'
       // ]);
   // }
    
    private function handleUpdateAlbums($request, $organizerUpdate)
    {
        // Delete all existing albums if new albums are provided
        $organizerUpdate->albums()->delete();

        $albumsData = $this->extractAlbumData($request);
        foreach ($albumsData as $albumData) {
            $album = new OrganizerUpdateAlbum($albumData);
            $album->organizer_update_id = $organizerUpdate->id;
            $album->save();

            // Handle file uploads
            if (isset($albumData['imageFiles'])) {
                $album->images = json_encode($this->handleFiles($albumData['imageFiles'], 'OrganizerImages'));
            }
            if (isset($albumData['videoFiles'])) {
                $album->videos = json_encode($this->handleFiles($albumData['videoFiles'], 'OrganizerVideos'));
            }
            $album->save();
        }
    }


    private function handleAlbums($request, $organizer)
    {
        // Delete all existing albums if new albums are provided
        $organizer->albums()->delete();

        $albumsData = $this->extractAlbumData($request);
        foreach ($albumsData as $albumData) {
            $album = new OrganizerAlbum($albumData);
            $album->organizer_id = $organizer->id;
            $album->save();

            // Handle file uploads
            if (isset($albumData['imageFiles'])) {
                $album->images = json_encode($this->handleFiles($albumData['imageFiles'], 'OrganizerImages'));
            }
            if (isset($albumData['videoFiles'])) {
                $album->videos = json_encode($this->handleFiles($albumData['videoFiles'], 'OrganizerVideos'));
            }
            $album->save();
        }
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


    public function organizerFollowers()
    {
        $organizer_id = $this->getOrganizerId() ;
        $result = $this->organizerService->getOrganizerFollowers($organizer_id);

        return response()->json($result);
    }

    public function getOrganizerProfile()
    {
        $organizer_id = $this->getOrganizerId() ;
        $result = $this->organizerService->getOrganizerProfile($organizer_id);

        return response()->json($result);
    }

    public function eventBooking($event_id)
    {
        $event = Event::withoutGlobalScopes()->with(['bookings' , 'bookings.user:id,first_name,last_name,image'])
            ->find($event_id);

        $organizer_id = $this->getOrganizerId() ;
        if ($event->organizer_id != $organizer_id)
        {
            return response()->json([
                'status' => false ,
                'Message' => 'Incorrect request'
            ]);
        }
        $bookings = $event->bookings;
        $bookingsGroupedByUser = $bookings->groupBy('user_id');

        return response()->json([
            'status' => true ,
            'Booking' => $bookingsGroupedByUser
        ]) ;
    }

    public function myEvent()
    {
        $organizer_id = $this->getOrganizerId() ;

        $events = Event::withoutGlobalScope('UpcomingEventScope')->with(['venue:id,name,name_ar','categories'])
            ->select('id','title' , 'title_ar', 'venue_id', 'start_date', 'end_date','capacity', 'images' , 'organizer_id')
            ->withCount('bookings')->where('organizer_id', $organizer_id)
            ->paginate(5);

        return response()->json([
            'status' => true ,
            'events' =>  $events
        ]) ;
    }

    public function getUserBooking(Request $request)
    {
        $booking = Booking::with(['event' => function($query) {
            $query->withoutGlobalScopes();
        } ,'event.amenities'=> function($query) {
                $query->withoutGlobalScopes();
            }, 'event.venue', 'event.organizer', 'promoCode' , 'offer' , 'event.classes'])
            ->where('user_id' , $request['user_id'])
            ->where('event_id' ,$request['event_id'] )
            ->get() ;

        return response()->json([
            'status' => true ,
            'bookings'=> $booking
        ]);

    }

}
