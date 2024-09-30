<?php

namespace App\Services\web;

use App\Models\Common\Amenity;
use Illuminate\Support\Facades\Storage;

class InterestService
{
    public function getAllInterests()
    {
        return Amenity::all();
    }

    public function storeInterest($request, $fileStorageTrait)
    {
        $path = $fileStorageTrait->storefile($request->file('icon'), 'AmenityImages');
        return Amenity::create([
            'title' => $request['title'],
            'title_ar' => $request['title_ar'],
            'icon' => $path
        ]);
    }

    public function updateInterest($request, $fileStorageTrait ,$id)
    {
        $interest = Amenity::findOrFail($id);

        $interest->title = $request->title;
        $interest->title_ar = $request->title_ar;

        if ($request->hasFile('icon')) {
            Storage::disk('public')->delete($interest->icon);
            $path = $fileStorageTrait->storefile($request->file('icon') , 'AmenityImages') ;
            $interest->icon = $path ;
        }

        $interest->save();
    }

    public function deleteInterest(Amenity $interest)
    {
        $interest->delete();
    }
}
