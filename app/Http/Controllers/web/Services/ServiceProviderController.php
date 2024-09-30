<?php

namespace App\Http\Controllers\web\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Services\ServiceProviderRequest;
use App\Http\Requests\Services\ServiceProviderUpdateRequest;
use App\Models\ServiceProvider\ServiceCategory;
use App\Models\ServiceProvider\ServiceProvider;
use App\Models\User\MobileUser;
use App\Services\web\ServiceProviderService;
use App\Traits\FileStorageTrait;
use Illuminate\Support\Facades\Storage;

class ServiceProviderController extends Controller
{
    protected $serviceProviderService;
    use FileStorageTrait;

    public function __construct(ServiceProviderService $serviceProviderService)
    {
        $this->serviceProviderService = $serviceProviderService;
    }

    public function index()
    {
        $serviceProviders = $this->serviceProviderService->getAllServiceProviders();
        return view('service_providers.index', compact('serviceProviders'));
    }

    public function create()
    {
        $categories = ServiceCategory::all();
        $users = MobileUser::where('type','normal')->get();
        return view('service_providers.create', compact('categories','users'));
    }

    public function store(ServiceProviderRequest $request)
    {
        $albumData = $this->extractAlbumData($request);
        $serviceProviderData = $request->all();

        // Assuming extractAlbumData returns an array of album information
        $this->serviceProviderService->createServiceProvider($serviceProviderData, $albumData);

        return redirect()->route('service-providers.index')->with('success', 'ServiceProvider created successfully.');
    }

    private function extractAlbumData($request) {
        $albums = [];

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

    public function show(ServiceProvider $serviceProvider)
    {
        $categories = ServiceCategory::all();
        return view('service_providers.show', compact('serviceProvider', 'categories'));
    }

    public function edit(ServiceProvider $serviceProvider)
    {
        $categories = ServiceCategory::all();
        return view('service_providers.edit', compact('serviceProvider', 'categories'));
    }

    public function update(ServiceProviderUpdateRequest $request, ServiceProvider $serviceProvider)
    {
        $data = $request->except(['profile', 'cover']); // Exclude profile and cover from the data
        if ($request->hasFile('profile') ) {
            Storage::disk('public')->delete($serviceProvider->profile);
            $data['profile'] = $this->storefile($request->file('profile'), 'ServiceProviderImages');
        }
        if ($request->hasFile('cover') ) {
            Storage::disk('public')->delete($serviceProvider->cover);
            $data['cover'] = $this->storefile($request->file('cover'), 'ServiceProviderImages');
        }

        $this->serviceProviderService->updateServiceProvider($serviceProvider, $data);

        return redirect()->route('service-providers.index')->with('success', 'ServiceProvider updated successfully.');
    }

    public function destroy(ServiceProvider $serviceProvider)
    {
        $this->serviceProviderService->deleteServiceProvider($serviceProvider);
        return redirect()->route('service-providers.index')->with('success', 'ServiceProvider deleted successfully.');
    }
}
