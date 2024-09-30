<?php

namespace App\Http\Controllers\web\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\InterestRequest;
use App\Models\Common\Amenity;
use App\Services\web\InterestService;
use App\Traits\FileStorageTrait;
use Illuminate\Http\Request;


class InterestController extends Controller
{
    use FileStorageTrait;

    protected $interestService;

    public function __construct(InterestService $interestService)
    {
        $this->interestService = $interestService;
    }

    public function index()
    {
        $interests = $this->interestService->getAllInterests();
        return view('interest.index', compact('interests'));
    }

    public function create()
    {
        return view('interest.create');
    }

    public function store(InterestRequest $request)
    {
        $this->interestService->storeInterest($request, $this);
        return redirect()->route('interest.index')->with('success', 'interest created successfully.');
    }

    public function show(Amenity $interest)
    {
        return view('interest.show', compact('interest'));
    }

    public function edit(Amenity $interest)
    {
        return view('interest.edit', compact('interest'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'title_ar' => 'required|max:255',
            'icon' => 'image|max:2048',
        ]);
        $this->interestService->updateInterest($request, $this ,$id);
        return redirect()->route('interest.index')->with('success', 'Amenity updated successfully');
    }

    public function destroy(Amenity $interest)
    {
        $this->interestService->deleteInterest($interest);
        return redirect()->route('interest.index')->with('success', 'interest deleted successfully.');
    }
}
