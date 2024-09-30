<?php

namespace App\Services\web;

use App\Models\Event\EventRequestCategory;
use App\Traits\FileStorageTrait;
use Illuminate\Support\Facades\Storage;

class EventsRequestCategoryService
{
    use FileStorageTrait;

    public function getAllEventCategories()
    {
        return EventRequestCategory::all();
    }

    public function createEventRequestCategory($data)
    {
        $image = $this->storefile($data['icon'], 'EventRequestCategoryImages');
        $data['icon'] = $image;

        return EventRequestCategory::create($data);
    }


    public function updateEventRequestCategory($request ,$id)
    {
        $event_category = EventRequestCategory::findOrFail($id);

        $event_category->title = $request->title;
        $event_category->title_ar = $request->title_ar;

        if ($request->hasFile('icon')) {
            Storage::disk('public')->delete($event_category->icon);
            $path = $this->storefile($request->file('icon') , 'EventRequestCategoryImages') ;
            $event_category->icon = $path ;
        }

        $event_category->save();
    }

    public function deleteEventRequestCategory(EventRequestCategory $eventsCategory)
    {
        $eventsCategory->delete();
    }
}
