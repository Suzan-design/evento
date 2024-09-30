@extends('layout.master')

@section('title', 'Show Reel')

@section('css')
    <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .detail-label {
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .detail-value {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f0f0f0;
            color: #333;
        }

        .media-container {
            display: grid; /* Use grid layout */
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Define the number of columns */
            gap: 20px; /* Space between items */
        }

        .media-container video {
            width: 100%; /* Ensure videos take full width of their grid cells */
            height: 150px; /* Set a consistent height for all videos */
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            object-fit: cover; /* Ensures video content covers the set dimensions */
        }

        #map {
            height: 400px;
            margin-bottom: 20px;
        }

        .vjs-text-track-settings,
        .vjs-tech > div {
            display: none !important;
        }
    </style>
@endsection

@section('content')
    <hr />
    <div class="container">
        @if($reel->organizer_id)
            <div class="detail-label">Organizer ID</div>
            <div class="detail-value">{{ $reel->organizer_id }}</div>
        @elseif($reel->event_id)
            <div class="detail-label">Event ID</div>
            <div class="detail-value">{{ $reel->event_id }}</div>
        @else
            <div class="detail-label">Venue ID</div>
            <div class="detail-value">{{ $reel->venue_id }}</div>
        @endif

        <div class="detail-label">Description</div>
        <div class="detail-value">{{ $reel->description }}</div>

        <div class="detail-label">Description AR</div>
        <div class="detail-value">{{ $reel->description_ar }}</div>

        <div class="detail-label">Videos</div>
        <div class="media-container">
            @if($reel->videos)
                @foreach(json_decode($reel->videos) as $video)
                <div class="video-container">
                    <video id="video_{{ $loop->index }}" class="video-js vjs-default-skin"  width="200" height="200" controls preload="auto">
                        <source src="{{ asset('storage/' . $video) }}" type="application/x-mpegURL">
                            <button type="button" class="btn btn-danger removeVideoBtn" data-index="{{ $video }}"><i class="bi bi-x"></i></button>
                            <input type="hidden" name="existing_videos[]" value="{{ $video }}">
                    </video>
                </div>
                @endforeach
            @else
                <div class="detail-value">No videos available</div>
            @endif
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/video.js/dist/video.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.vjs-default-skin').forEach(function(element) {
                var player = videojs(element, {
                    controls: true,
                    autoplay: false,
                    preload: 'auto',
                    controlBar: false,
                    bigPlayButton: false,
                    textTrackDisplay: false,
                    errorDisplay: false,
                    loadingSpinner: false
                });

                player.on('ended', function() {
                    var nextVideo = document.querySelector('#video_' + (parseInt(element.id.split('_')[1]) + 1));
                    if (nextVideo) {
                        videojs(nextVideo).play();
                    }
                });
            });
        });
    </script>
@endsection
