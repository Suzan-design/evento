<?php

namespace App\Http\Controllers\web\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventCategoryRequest;
use App\Models\Event\EventCategory;
use App\Services\web\EventsCategoryService;
use Illuminate\Http\Request;

class EventsCategoryController extends Controller
{
    protected $eventsCategoryService;

    public function __construct(EventsCategoryService $eventsCategoryService)
    {
        $this->eventsCategoryService = $eventsCategoryService;
    }

    public function index()
    {
        $eventsCategory = $this->eventsCategoryService->getAllEventCategories();
        return view('categories.index', compact('eventsCategory'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(EventCategoryRequest $request)
    {
        $this->eventsCategoryService->createEventCategory($request->all());
        return redirect()->route('events-categories.index')->with('success', 'EventsCategory created successfully.');
    }

    public function show(EventCategory $events_category)
    {
        return view('categories.show', compact('events_category'));
    }

    public function edit(EventCategory $events_category)
    {
        return view('categories.edit', compact('events_category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'icon'=> 'image|max:2048'
          ]);

        $this->eventsCategoryService->updateEventCategory($request ,$id);
        return redirect()->route('events-categories.index')->with('success', 'EventsCategory updated successfully');
    }

    public function destroy(EventCategory $events_category)
    {
        $this->eventsCategoryService->deleteEventCategory($events_category);
        return redirect()->route('events-categories.index')->with('success', 'EventsCategory deleted successfully.');
    }
}
