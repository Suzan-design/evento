@extends('layout.master')

@section('title')
    Show Venue
@endsection

@section('css')
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 70%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .detail-label {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .detail-value {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f4f4f4;
        }

        .media-container {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .album-container {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .album-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        img, video {
            max-width: 100%;
            border-radius: 5px;
        }
    </style>
@endsection

@section('content')
    <h2>Venue Details</h2>
    <hr />
    <div class="container">
        <div class="detail-label">Name</div>
        <div class="detail-value">{{ $venue->name }}</div>

        <div class="detail-label">Name</div>
        <div class="detail-value">{{ $venue->name_ar }}</div>

        <div class="detail-label">Capacity</div>
        <div class="detail-value">{{ $venue->capacity }}</div>

        <div class="detail-label">Governorate</div>
        <div class="detail-value">{{ $venue->governorate }}</div>

        <div class="detail-label">Location Description</div>
        <div class="detail-value">{{ $venue->location_description }}</div>


        <div class="detail-label">Location Description AR</div>
        <div class="detail-value">{{ $venue->location_description_ar }}</div>

        <div class="detail-label">Map</div>
        <div id="map"></div>

        <div class="detail-label">Latitude</div>
        <div class="detail-value">{{ $venue->latitude }}</div>

        <div class="detail-label">Longitude</div>
        <div class="detail-value">{{ $venue->longitude }}</div>

        <div class="detail-label">Contact Number</div>
        <div class="detail-value">{{ $venue->contact_number }}</div>


        <div class="detail-label">Description</div>
        <div class="detail-value">{{ $venue->description }}</div>


        <div class="detail-label">Description AR</div>
        <div class="detail-value">{{ $venue->description_ar }}</div>

        <div class="detail-label">Profile</div>
        <div class="media-container">
            <img src="{{ asset('storage/' . $venue->profile) }}" alt="Venue Icon" style="max-height: 200px;"> <!-- Responsive and bounded image height -->
        </div>

        <hr />
    @foreach ($venue->albums as $album)
            <div class="album-container">
                <div class="album-title">{{ $album->name }}</div>

                <div class="detail-label">Images</div>
                <div class="media-container">
                    @if($album->images)
                        @foreach(json_decode($album->images) as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Album Image">
                        @endforeach
                    @else
                        <div class="detail-value">No images available</div>
                    @endif
                </div>

                <div class="detail-label">Videos</div>
                <div class="media-container">
                    @if($album->videos)
                        @foreach(json_decode($album->videos) as $video)
                            <video width="200" controls>
                                <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endforeach
                    @else
                        <div class="detail-value">No videos available</div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCA7gH--Lsl3iK1KcjHVBJtV-WPpMBPenE&callback=initMap" async defer></script>
    <script>
        function initMap() {
            var mapOptions = {
                zoom: 8,
                center: new google.maps.LatLng({{ $venue->latitude }}, {{ $venue->longitude }})
            };

            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            var marker = new google.maps.Marker({
                position: { lat: {{ $venue->latitude }}, lng: {{ $venue->longitude }} },
                map: map
            });
        }
    </script>
@endsection
