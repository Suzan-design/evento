<?php

namespace App\Services\web;

use App\Models\ServiceProvider\ServiceCategory;
use App\Traits\FileStorageTrait;
use Illuminate\Support\Facades\Storage;

class ServicesCategoryService
{
    use FileStorageTrait;

    public function getAllServiceCategories()
    {
        return ServiceCategory::all() ;
    }

    public function createServiceCategory($data)
    {
        $path = $this->storefile($data['icon'], 'ServiceCategoryImages');
        $data['icon'] = $path;
        return ServiceCategory::create($data);
    }

    public function updateServiceCategory($request ,$id)
    {
        $ServicesCategory = ServiceCategory::findOrFail($id);

        $ServicesCategory->title = $request->title;
        $ServicesCategory->title_ar = $request->title_ar;
        $ServicesCategory->description = $request->description;
        $ServicesCategory->description_ar = $request->description_ar;

        if ($request->hasFile('icon')) {
            Storage::disk('public')->delete($ServicesCategory->icon);
            $path = $this->storefile($request->file('icon') , 'ServiceCategoryImages') ;
            $ServicesCategory->icon = $path ;
        }

        $ServicesCategory->save();
    }

    public function deleteServiceCategory(ServiceCategory $servicesCategory)
    {
        $servicesCategory->delete();
    }
}
