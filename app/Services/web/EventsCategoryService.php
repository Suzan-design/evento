<?php

namespace App\Services\web;

use App\Models\Event\EventCategory;
use App\Traits\FileStorageTrait;
use Illuminate\Support\Facades\Storage;

class EventsCategoryService
{
    use FileStorageTrait;

    public function getAllEventCategories()
    {
        return EventCategory::all();
    }

    public function createEventCategory($data)
    {
        $image = $this->storefile($data['icon'], 'EventCategoryImages');
        $data['icon'] = $image;

        return EventCategory::create($data);
    }


    public function updateEventCategory($request ,$id)
    {
        $event_category = EventCategory::findOrFail($id);

        $event_category->title = $request->title;
        $event_category->title_ar = $request->title_ar;

        if ($request->hasFile('icon')) {
            Storage::disk('public')->delete($event_category->icon);
            $path = $this->storefile($request->file('icon') , 'EventCategoryImages') ;
            $event_category->icon = $path ;
        }

        $event_category->save();
    }

    public function deleteEventCategory(EventCategory $eventsCategory)
    {
        $eventsCategory->delete();
    }
}
