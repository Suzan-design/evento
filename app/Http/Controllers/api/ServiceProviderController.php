<?php

namespace App\Http\Controllers\api;
use App\Http\Requests\Services\ServiceProviderRequest;
use App\Models\ServiceProvider\ServiceCategory;
use App\Models\ServiceProvider\ServiceProvider;
use App\Services\api\ServiceProviderService;
use App\Traits\FileStorageTrait;

class ServiceProviderController extends Controller
{
    use FileStorageTrait ;
    private $serviceProviderService;

    public function __construct(ServiceProviderService $serviceProviderService)
    {
        $this->serviceProviderService = $serviceProviderService;
    }

    public function become_service_provider(ServiceProviderRequest $request)
    {
        $data = $request->all() ;
        $albumsData = $this->extractAlbumData($request) ;
        $result = $this->serviceProviderService->becomeServiceProvider($data, $albumsData);

        return response()->json($result);

    }

    protected function extractAlbumData($request) {
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


    public function show($id)
    {
        $serviceProvider = $this->serviceProviderService->getServiceProviderById($id);

        if ($serviceProvider) {
            return response()->json([
                'status' => true,
                'message' => $serviceProvider
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'not found'
            ]);
        }
    }

    public function service_category()
    {
        $categories = $this->serviceProviderService->getAllServiceCategories();

        return response()->json([
            'status' => true,
            'category' => $categories
        ]);
    }

    public function serviceProviderAccordingCategory($id)
    {
        $serviceProviders = $this->serviceProviderService->getServiceProvidersByCategory($id);

        return response()->json([
            'status' => true,
            'service_provider' => $serviceProviders
        ]);
    }
}
