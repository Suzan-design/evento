<?php

namespace App\Http\Controllers\web\Venue;

use App\Http\Controllers\Controller;
use App\Http\Requests\Venue\VenueRequest;
use App\Http\Requests\Venue\VenueUpdateRequest;
use App\Models\Venue\Venue;
use App\Services\web\VenueService;
use App\Traits\FileStorageTrait;
use Illuminate\Support\Facades\Storage;

class VenueController extends Controller
{
    protected $venueService;
    use FileStorageTrait ;
    public function __construct(VenueService $venueService)
    {
        $this->venueService = $venueService;
    }

    public function index()
    {
        $venues = $this->venueService->getAllVenues();
        return view('venues.index', compact('venues'));
    }

    public function create()
    {
        return view('venues.create');
    }

    public function store(VenueRequest $request)
    {
        $albumData = $this->extractAlbumData($request);
        $venueData = $request->all();
        $this->venueService->createVenue($venueData,$albumData);

        return redirect()->route('venues.index')->with('success', 'Venue created successfully.');
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

    public function show(Venue $venue)
    {
        return view('venues.show', compact('venue'));
    }

    public function edit(Venue $venue)
    {
        return view('venues.edit', compact('venue'));
    }

    public function update(VenueUpdateRequest $request, Venue $venue)
    {
        $data = $request->except(['profile']); // Exclude profile and cover from the data

        if ($request->hasFile('profile') ) {
            Storage::disk('public')->delete($venue->profile);
            $data['profile'] = $this->storefile($request->file('profile'), 'VenueImages');
        }
        $this->venueService->updateVenue($venue, $data);
        return redirect()->route('venues.index')->with('success', 'Venue updated successfully.');
    }

    public function destroy(Venue $venue)
    {
        $this->venueService->deleteVenue($venue);
        return redirect()->route('venues.index')->with('success', 'Venue deleted successfully.');
    }
}
