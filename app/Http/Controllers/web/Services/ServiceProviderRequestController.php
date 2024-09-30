<?php

namespace App\Http\Controllers\web\Services;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvider\ServiceProvider;
use App\Scopes\ExcludeAttributeScope;
use App\Services\web\ServiceProviderRequestService;
use Illuminate\Http\Request;

class ServiceProviderRequestController extends Controller
{
    protected $serviceProviderRequestService;

    public function __construct(ServiceProviderRequestService $serviceProviderRequestService)
    {
        $this->serviceProviderRequestService = $serviceProviderRequestService;
    }

    public function index()
    {
        $service_providers = $this->serviceProviderRequestService->getAllServiceProviderRequests();
        return view('service_provider_request.index',compact('service_providers'));
    }

    public function show($id)
    {
        $serviceProvider =  ServiceProvider::with(['user','category','albums'])->withoutGlobalScope(ExcludeAttributeScope::class)->find($id);
        return view('service_provider_request.show', compact('serviceProvider'));
    }

    public function update(Request $request, $id)
    {
        $this->serviceProviderRequestService->updateServiceProviderRequest($id, $request->all());
        return redirect()->route('serviceProvider-requests.index');
    }

    public function destroy($id)
    {
        $this->serviceProviderRequestService->deleteServiceProviderRequest($id);
        return redirect()->route('serviceProvider-requests.index')->with('success', 'EventRequest deleted successfully.');
    }

}
