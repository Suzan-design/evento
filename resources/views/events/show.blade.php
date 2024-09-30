@extends('layout.master')

@section('title')
    Show Event
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        h5 {
            color: #007bff;
            margin-bottom: 15px;
        }

        p, label, .list-group-item {
            color: #555;
        }

        .list-group-item {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }

        .form-control-static {
            background-color: #f9f9f9;
            border: none;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        .classGroup, .media-container img, video {
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .media-container img, video {
            width: 100%;
            max-width: 200px;
            height: auto;
        }

        .media-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                margin: 20px auto;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <hr/>
        <div class="form-style">
            <div class="row mb-3">
                <label>Title</label>
                <div class="col">
                    <p class="form-control-static">{{ $event->title }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label>Title AR</label>
                <div class="col">
                    <p class="form-control-static">{{ $event->title_ar }}</p>
                </div>
            </div>
            <hr />

            <div class="row mb-3">
                <label>Capacity</label>
                <div class="col">
                    <p class="form-control-static">{{ $event->capacity }}</p>
                </div>
            </div>

            <hr />
            <div class="row mb-3">
                <label>Venue</label>
                <div class="col">
                    <p class="form-control-static">{{ $event->venue->name }}</p>
                </div>
            </div>

            <hr />
            <div class="row mb-3">
                <label>Categories</label>
                <div class="col">
                    <ul class="list-group">
                        @foreach($event->categories as $category)
                            <li class="list-group-item">{{ $category->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <hr />
            <div class="row mb-3">
                <label>Amenity</label>
                <div class="col">
                    <ul class="list-group">
                        @foreach($event->amenities as $amenity)
                            <li class="list-group-item">{{ $amenity->title }}</li>
                            <li class="list-group-item">{{ $amenity->pivot->price }}</li>
                            <li class="list-group-item">{{ $amenity->pivot->description }}</li>
                            <li class="list-group-item">{{ $amenity->pivot->description_ar }}</li>

                            <hr />
                        @endforeach
                    </ul>
                </div>
            </div>

            <hr />

            <!-- Assuming you have a relationship to get classes -->
            <div class="row mb-3">
                <label>Classes</label>
                <div class="col">
                    @foreach($event->classes as $class)
                        <div class="classGroup mt-3">
                            <h5>Class: {{ $class->code }}</h5>
                            <p>Ticket Price: {{ $class->ticket_price }}</p>
                            <p>Description: {{ $class->description }}</p>
                            <p>Description AR: {{ $class->description_ar }}</p>

                            <!-- List interest for this class -->
                            <ul class="list-group">
                                @foreach($class->amenities as $amenities)
                                    <li class="list-group-item">{{ $amenities->title }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <hr />
            <div class="row mb-3">
                <label>Start Date</label>
                <div class="col">
                    <p class="form-control-static">{{ $event->start_date }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <label>End Date</label>
                <div class="col">
                    <p class="form-control-static">{{ $event->end_date }}</p>
                </div>
            </div>

            <hr />
            <div class="row mb-3">
                <label>Ticket Price</label>
                <div class="col">
                    <p class="form-control-static">{{ $event->ticket_price }}</p>
                </div>
            </div>

            <hr />

            <!-- Assuming you have a relationship to get service providers -->
            <div class="row mb-3">
                <label>Service Providers</label>
                <div class="col">
                    <ul class="list-group">
                        @foreach($event->serviceProviders()->get() as $serviceProvider)
                            <li class="list-group-item">{{ $serviceProvider->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>


            <hr />
            <div class="row mb-3">
                <label>Event Trips</label>
                <div class="col">
                    @if($event->eventTrips->isNotEmpty())
                        @foreach($event->eventTrips as $eventTrip)
                            <div class="classGroup mt-3">
                                <h5>Event Trip</h5>
                                <p>Date and Time: {{ $eventTrip->start_date }}</p>
                                <p>Date and Time: {{ $eventTrip->end_date }}</p>
                                <p>Description: {{ $eventTrip->description }}</p>
                                <p>Description AR: {{ $eventTrip->description_ar }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="form-control-static">No event trips available.</p>
                    @endif
                </div>
            </div>

            <hr />
            <div class="detail-label">Images</div>
            <div class="media-container">
                @if($event->images)
                    @foreach(json_decode($event->images) as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="EVENT Image">
                    @endforeach
                @else
                    <div class="detail-value">No images available</div>
                @endif
            </div>

            <div class="detail-label">Videos</div>
            <div class="media-container">
                @if($event->videos)
                    @foreach(json_decode($event->videos) as $video)
                        <video width="200" controls>
                            <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endforeach
                @else
                    <div class="detail-value">No videos available</div>
                @endif
            </div>

            <div class="row mb-3">
                <label>Description</label>
                <div class="col">
                    <p class="form-control-static">{{ $event->description }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <label>Description AR</label>
                <div class="col">
                    <p class="form-control-static">{{ $event->description_ar }}</p>
                </div>
            </div>

            @if($event->website)
            <div class="row mb-3">
                <label>Website</label>
                <div class="col">
                    <p class="form-control-static">{{ $event->website }}</p>
                </div>
            </div>
            @endif

            @if($event->instagram)
            <div class="row mb-3">
                <label>Instagram</label>
                <div class="col">
                    <p class="form-control-static">{{ $event->instagram }}</p>
                </div>
            </div>
            @endif

            @if($event->facebook)
            <div class="row mb-3">
                <label>Facebook</label>
                <div class="col">
                    <p class="form-control-static">{{ $event->facebook }}</p>
                </div>
            </div>
            @endif

            @if($event->refund_policy)
            <div class="row mb-3">
                <label>Refund Policy</label>
                <div class="col">
                    <p class="form-control-static">{{ $event->refund_policy }}</p>
                </div>
            </div>
            @endif

            @if($event->cancellation_policy)
            <div class="row mb-3">
                <label>Cancellation Policy</label>
                <div class="col">
                    <p class="form-control-static">{{ $event->cancellation_policy }}</p>
                </div>
            </div>
            @endif

            @if($event->refund_policy_ar)
            <div class="row mb-3">
                <label>Refund Policy (AR)</label>
                <div class="col">
                    <p class="form-control-static">{{ $event->refund_policy_ar }}</p>
                </div>
            </div>
            @endif

            @if($event->cancellation_policy_ar)
            <div class="row mb-3">
                <label>Cancellation Policy (AR)</label>
                <div class="col">
                    <p class="form-control-static">{{ $event->cancellation_policy_ar }}</p>
                </div>
            </div>
            @endif

        </div>
    </div>
@endsection
