<?php

namespace App\Http\Controllers\web\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Services\ServicesCategoryRequest;
use App\Models\ServiceProvider\ServiceCategory;
use App\Services\web\ServicesCategoryService;
use Illuminate\Http\Request;

class ServicesCategoryController extends Controller
{
    protected $servicesCategoryService;

    public function __construct(ServicesCategoryService $servicesCategoryService)
    {
        $this->servicesCategoryService = $servicesCategoryService;
    }

    public function index()
    {
        $ServicesCategory = $this->servicesCategoryService->getAllServiceCategories();
        return view('service_categories.index', compact('ServicesCategory'));
    }

    public function create()
    {
        return view('service_categories.create');
    }

    public function store(ServicesCategoryRequest $request)
    {
        $this->servicesCategoryService->createServiceCategory($request->all());
        return redirect()->route('services-categories.index')->with('success', 'ServicesCategory created successfully.');
    }

    public function show(ServiceCategory $ServicesCategory)
    {
        return view('service_categories.show', compact('ServicesCategory'));
    }

    public function edit(ServiceCategory $ServicesCategory)
    {
        return view('service_categories.edit', compact('ServicesCategory'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'description_ar' => 'required|string|max:500',
            'icon' =>'image'
        ]);
        $this->servicesCategoryService->updateServiceCategory($request ,$id);
        return redirect()->route('services-categories.index')->with('success', 'ServicesCategory updated successfully');
    }

    public function destroy(ServiceCategory $servicesCategory)
    {
        $this->servicesCategoryService->deleteServiceCategory($servicesCategory);
        return redirect()->route('services-categories.index')->with('success', 'ServiceCategory deleted successfully.');
    }
}
