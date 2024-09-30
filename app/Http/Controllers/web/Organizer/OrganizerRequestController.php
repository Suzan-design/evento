<?php

namespace App\Http\Controllers\web\Organizer;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\RequestedEvent\RequestedEventUpdateRequest;
use App\Models\Event\EventRequest;
use App\Models\User\MobileUser;
use App\Models\User\Organizer;
use App\Models\User\OrganizerUpdate;
use App\Scopes\ExcludeAttributeScope;
use App\Services\web\OrganizerRequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Action\Notification;
use App\Http\Controllers\api\Action\NotificationController;

class OrganizerRequestController extends Controller
{
    protected $organizerRequestService;

    public function __construct(OrganizerRequestService $organizerRequestService)
    {
        $this->organizerRequestService = $organizerRequestService;
    }

    public function index()
    {
        $organizers = $this->organizerRequestService->getAllOrganizerRequests();
        return view('organizer_request.index', compact('organizers'));
    }
    
    public function updatedOrganizerRequests()
    {
        $updated_organizers = $this->organizerRequestService->updatedOrganizerRequests();
        return view('updated_organizer_request.index', compact('updated_organizers'));
    }
    
    public function acceptUpdate($id)
    {
        $organizer_update = OrganizerUpdate::findOrFail($id);
        $organizer = Organizer::findOrFail($organizer_update->organizer_id);
        
        // Update Organizer
        // Convert the $organizer_update object to an array
        $organizer_data = $organizer_update->toArray();
        
        // Remove 'profile' and 'cover' from the array if they exist
        unset($organizer_data['profile'], $organizer_data['cover']);
        
        // Update the organizer with the remaining data
        $organizer->update($organizer_data);
        
        // Check if 'profile' is set and not null, then update it
        if (isset($organizer_update->profile) && !is_null($organizer_update->profile)) {
            $organizer->update(['profile' => $organizer_update->profile]);
        }
        
        // Check if 'cover' is set and not null, then update it
        if (isset($organizer_update->cover) && !is_null($organizer_update->cover)) {
            $organizer->update(['cover' => $organizer_update->cover]);
        }

    
        // Categories handling
        $categories_id = DB::table('event_categories')
            ->join('updated_organizer_categories', 'event_categories.id', '=', 'updated_organizer_categories.event_category_id')
            ->where('updated_organizer_categories.organizer_update_id', $organizer_update->id)
            ->pluck('event_categories.id');
    
        $organizer->categories()->sync($categories_id ?? []);
    
        // Retrieve albums
        $albums = $organizer_update->albums()->get(); // Fetch the albums related to the organizer_update
        foreach ($organizer->albums as $album) {
            $album->delete();
        }

        // Insert albums into the organizer_albums_updates table
        foreach ($albums as $album) {
            DB::table('organizer_albums')->insert([
                'organizer_id' => $organizer_update->organizer_id,
                'name' => $album->name, // Assuming the album has a 'name' field
                'images' => $album->images,
                'videos' => $album->videos
            ]);
        }
        $organizer_update->delete();
       
                Notification::create([
                    'title' => 'Your request accepted',
                    'description' => 'Your udpate profile request accepted from admin',
                    'user_id' => $organizer->mobile_user_id ,
                    'title_ar' => 'تم قبول طلبك',
                    'description_ar' => 'تم قبول طلب تعديل معلومات الخاصة بك'
                ]);
                $notificationController = new NotificationController();
                $notificationController->sentNotification($organizer->mobile_user_id, 'Your request accepted', 'You have booked Successfully in event'
                    , 'تم قبول طلبك', 'تم قبول طلب تعديل معلومات الخاصة بك');
            
        return redirect()->back()->with('success','update request accepted successfully');
    }

 
    public function rejectUpdate($id){
    $organizer_update = OrganizerUpdate::findOrFail($id);
    $organizer_update->delete();
    $organizer = Organizer::findOrFail($organizer_update->organizer_id);
    //dd($organizer);
     
                Notification::create([
                    'title' => 'Your request rejected',
                    'description' => 'Your udpate profile request rejected from admin',
                    'user_id' => $organizer->mobile_user_id ,
                    'title_ar' => 'تم قبول طلبك',
                    'description_ar' => 'تم قبول طلب تعديل معلومات الخاصة بك'
                ]);
                $notificationController = new NotificationController();
                $notificationController->sentNotification($organizer->mobile_user_id, 'Your request rejected', 'You have booked rejected in event'
                    , 'تم قبول طلبك', 'تم قبول طلب تعديل معلومات الخاصة بك');
            
        return redirect()->back()->with('error','update request rejected successfully');
    }
    
    public function show($id)
    {
        $organizer =  Organizer::withoutGlobalScope(ExcludeAttributeScope::class)->with(['mobileUser' , 'categories' ,'albums'])->find($id);
        return view('organizer_request.show', compact('organizer'));
    }

    public function update(Request $request,$id)
    {
        $this->organizerRequestService->updateOrganizerRequest($id, $request->all());
        return redirect()->route('organizer-requests.index');
    }

    public function destroy($id)
    {
        $this->organizerRequestService->deleteOrganizerRequest($id);
        return redirect()->route('organizer-requests.index')->with('success', 'Organizer Request deleted successfully.');
    }
}
