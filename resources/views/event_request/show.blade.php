@extends('layout.master')

@section('title', 'Show Request')

@section('css')
<style>
    .media-container img, video {
    width: 100%;
    max-width: 200px;
    height: auto;
    }
    
</style>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Event Request Details
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $event_request->title }}</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6>User Information</h6>
                        <p><strong>User ID:</strong> {{ $event_request->user_id }}</p>
                        <p><strong>Name:</strong> {{ $event_request->first_name }} {{ $event_request->last_name }}</p>
                        <p><strong>Phone Number:</strong> {{ $event_request->phone_number }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6>Event Details</h6>
                        <p><strong>Date:</strong> {{ $event_request->date->format('M d, Y') }}</p>
                        <p><strong>Time:</strong> {{ $event_request->start_time }} - {{ $event_request->end_time }}</p>
                        <p><strong>Status:</strong> <span class="badge {{ $event_request->status == 'Approved' ? 'badge-success' : ($event_request->status == 'Pending' ? 'badge-warning' : 'badge-info') }}">{{ $event_request->status }}</span></p>
                    </div>
                </div>
                <div class="mb-3">
                    <h6>Participants</h6>
                    <p><strong>Adults:</strong> {{ $event_request->adults }}</p>
                    <p><strong>Children:</strong> {{ $event_request->child }}</p>
                </div>
                <div class="mb-3">
                    <h6>Venue</h6>
                    <p>{{ $event_request->venue_id ? $event_request->venue->name : 'N/A' }}</p>
                </div>
                <div class="mb-3">
                    <h6>Description</h6>
                    <p>{{ $event_request->description }}</p>
                </div>
                <div class="mb-3">
                    <h6>Service Providers</h6>
                    @if($event_request->serviceProviders()->count() > 0)
                        <ul>
                            @foreach($event_request->serviceProviders() as $provider)
                                <li>{{ $provider->user->first_name }} {{ $provider->user->last_name }} - {{ $provider->category->title }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>N/A</p>
                    @endif
                </div>
                <div class="mb-3">
                    <h6>Additional Notes</h6>
                    <p>{{ $event_request->additional_notes ? $event_request->additional_notes :  'N/A' }}</p>
                </div>
                <div class="detail-label">Images</div>
                <div class="media-container">
                    @if($event_request->images)
                        @foreach(json_decode($event_request->images) as $image)
                            <img width="250px" height="250px" src="{{ asset('storage/' . $image) }}" alt="EVENT Image">
                        @endforeach
                    @else
                        <div class="detail-value">No images available</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection