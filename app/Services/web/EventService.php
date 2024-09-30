<?php
namespace App\Services\web;

use App\Models\Event\AmenityEvent;
use App\Models\Event\Event;
use App\Models\Event\EventClass;
use App\Models\Event\EventTrip;
use App\Traits\FileStorageTrait;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;

class EventService
{
    use FileStorageTrait ;
    public function getAllEvents()
    {
        return Event::withoutGlobalScope(\App\Scopes\UpcomingEventScope::class)->get();
    }

    public function createEvent($data , $imageFiles, $videoFiles)
    {
    //dd($data);
    //$data['amenity'] = $data['amenities'];
    //dd($data);
            $imagePaths = null;
            $videoPaths = null;

            if ($imageFiles)
                $imagePaths = $this->handleFiles($imageFiles, 'EventImages');

            if ($videoFiles)
                $videoPaths = $this->handleFiles($videoFiles, 'EventVideo');

            if ($imagePaths) {
                $data['images'] = json_encode($imagePaths);
            }
            if ($videoPaths) {
                $data['videos'] = json_encode($videoPaths);
            }
            
            $data['discount_type'] = $data['app_taxes_type'];
            $event = Event::create($data);
            //dd($event->classes);
            if (isset($data['category_ids']) && $data['category_ids'])
                $event->categories()->attach($data['category_ids']);

            if (isset($data['service_providers']) && $data['service_providers'])
                $event->serviceProviders()->attach($data['service_providers']);

            if (isset($data['amenity']) && $data['amenity'])
                $this->attachInterestToEvent($event, $data['amenity']);
            //dd($event->amenities);
            if (isset($data['classes']) && $data['classes'])
                $this->createEventClasses($event, $data['classes']);


    //dd($event->classes);
    
            if (isset($data['event_trips']) && $data['event_trips'])
                $this->createEventTrips($event, $data['event_trips']);
            DB::commit();

            return $event;
        
    }

    private function attachInterestToEvent($event, $amenity)
    {
        foreach ($amenity as $amenityId => $amenityData) {
            $createdAmenity = AmenityEvent::create([
                'event_id' => $event->id,
                'amenity_id' => $amenityId,
                'price' => $amenityData['price'],
                'description' => $amenityData['description'],
                'description_ar' => $amenityData['description_ar'],
            ]);
            
        }
    }

    private function createEventClasses($event, $classes)
    {
    //dd($classes);
        foreach ($classes as $classData) {
            $class = EventClass::create([
                'event_id' => $event->id,
                'code' => $classData['code'],
                'ticket_price' => $classData['ticket_price'],
                'ticket_number' => $classData['ticket_number'] ,
                'description' => $classData['description'] ,
                'description_ar' => $classData['description_ar']
            ]);
            $class->amenities()->sync($classData['amenity_ids']);
        }
    }

    private function createEventTrips($event, $eventTrips)
    {
        foreach ($eventTrips as $eventTripData) {
            EventTrip::create([
                'event_id' => $event->id,
                'start_date' => $eventTripData['start_date'],
                'end_date' => $eventTripData['end_date'],
                'description' => $eventTripData['description'],
                'description_ar' => $eventTripData['description_ar'],
            ]);
        }
    }

    public function updateEvent(Event $event, $request)
{
    $data = $request->except(['_token', '_method', 'classes', 'service_providers', 'event_trips']);

    // Ensure to update app_taxes_type, app_taxes_amount, and app_taxes_percent
    $data['discount_type'] = $request->app_taxes_type;
    if ($request->app_taxes_type === 'amount') {
        $data['app_taxes'] = $request->app_taxes;
    } else if ($request->app_taxes_type === 'percent') {
        $data['app_taxes'] = $request->app_taxes;
    }

    // Update the event itself
    $event->update($data);
    
    $existingImages = $request->existing_images ?? [];
    if ($request->hasFile('new_images')) {
        foreach ($request->file('new_images') as $imageFile) {
            // Compress image
            $image = Image::make($imageFile)->encode('jpg', 75);
            $filename = $imageFile->hashName();
            $image->save(storage_path('app/public/events/' . $filename));
    
            $path = 'events/' . $filename; // Update the path to use the compressed image
            $existingImages[] = $path;
        }
    }
    $event->images = json_encode($existingImages);

    // Handle existing videos and new videos
    $existingVideos = $request->existing_videos ?? [];
    if ($request->hasFile('new_videos')) {
        foreach ($request->file('new_videos') as $videoFile) {
            $filename = $videoFile->hashName();
            $destinationPath = storage_path('app/public/events/' . $filename);
    
            // Create an FFmpeg instance
            $ffmpeg = FFmpeg::create();
            $video = $ffmpeg->open($videoFile->getPathname());
            
            // Example of resizing the video
            //$video->filters()->resize(new Dimension(640, 480));

            // Save the video in a specific format
            $video->save(new X264('libmp3lame', 'libx264'), $destinationPath);
    
            $path = 'events/' . $filename;
            $existingVideos[] = $path;
        }
    }
    $event->videos = json_encode($existingVideos);
    $event->save();

    if ($request->has('amenity')) {
        foreach ($request->amenity as $amenityId => $details) {
            // Assuming you have a method to handle the update or creation of amenity details
            $this->updateAmenityDetails($event, $amenityId, $details);
        }
    }

    // Update classes
    $event->classes()->delete(); // Assuming you want to replace existing classes
    if ($request->has('classes')) {
        foreach ($request->classes as $classData) {
            $class = $event->classes()->create([
                'code' => $classData['code'],
                'ticket_price' => $classData['ticket_price'],
                'ticket_number' => $classData['ticket_number'],
                'description' => $classData['description'],
                'description_ar' => $classData['description_ar'],
            ]);
            if (isset($classData['amenity_ids'])) {
                $class->amenities()->sync($classData['amenity_ids']);
            }
        }
    }

    // Update service providers
    $event->serviceProviders()->sync($request->input('service_providers', []));

    // Update event trips
    $event->eventTrips()->delete(); // Assuming you want to replace existing event trips
    if ($request->has('event_trips')) {
        foreach ($request->event_trips as $tripData) {
            $event->eventTrips()->create([
                'start_date' => $tripData['start_date'],
                'end_date' => $tripData['end_date'],
                'description' => $tripData['description'],
                'description_ar' => $tripData['description_ar'],
            ]);
        }
    }
}


    protected function updateAmenityDetails($event, $amenityId, $details) {
        AmenityEvent::updateOrCreate(
            ['event_id' => $event->id, 'amenity_id' => $amenityId],
            ['description' => $details['description'], 'description_ar' => $details['description_ar'], 'price' => $details['price']]
        );
    }

    public function deleteEvent(Event $event)
    {
        $event->delete();
    }
}
