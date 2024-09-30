<?php

namespace App\Http\Controllers\web\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventCategoryRequest;
use App\Models\Event\EventRequestCategory;
use App\Services\web\EventsRequestCategoryService;
use Illuminate\Http\Request;

class EventRequestCategoryController extends Controller
{
    protected $eventsCategoryService;

    public function __construct(EventsRequestCategoryService $eventsCategoryService)
    {
        $this->eventsCategoryService = $eventsCategoryService;
    }

    public function index()
    {
        $events_request_categories = $this->eventsCategoryService->getAllEventCategories();
        return view('request-categories.index', compact('events_request_categories'));
    }

    public function create()
    {
        return view('request-categories.create');
    }

    public function store(EventCategoryRequest $request)
    {
        $this->eventsCategoryService->createEventRequestCategory($request->all());
        return redirect()->route('events-request-categories.index')->with('success', 'EventsCategory created successfully.');
    }

    public function show(EventRequestCategory $events_request_category)
    {
        return view('request-categories.show', compact('events_request_category'));
    }

    public function edit(EventRequestCategory $events_request_category)
    {
        return view('request-categories.edit', compact('events_request_category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'icon'=> 'image|max:2048'
          ]);

        $this->eventsCategoryService->updateEventRequestCategory($request ,$id);
        return redirect()->route('events-request-categories.index')->with('success', 'EventsCategory updated successfully');
    }

    public function destroy(EventRequestCategory $events_request_category)
    {
        $this->eventsCategoryService->deleteEventRequestCategory($events_request_category);
        return redirect()->route('events-request-categories.index')->with('success', 'EventsCategory deleted successfully.');
    }
}
