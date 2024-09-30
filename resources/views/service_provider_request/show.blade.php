@extends('layout.master')

@section('title')
    Show Request
@endsection

@section('css')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 60%;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .detail-label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .detail-value {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
            color: #555;
        }

        .media-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            margin-bottom: 20px;
        }

        .media-container img, .media-container video {
            width: 100%;
            height: auto;
            max-width: 100%;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .album-container {
            margin-bottom: 30px;
        }

        .album-title {
            font-size: 1.2em;
            margin-bottom: 10px;
            color: #333;
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

    <hr />
    <div class="container">
        <div class="detail-label">User Name</div>
        <div class="detail-value">{{ $serviceProvider->user->first_name }}  {{$serviceProvider->user->last_name}}</div>

        <div class="detail-label">Organizer Name</div>
        <div class="detail-value">{{ $serviceProvider->name }}</div>

        <div class="detail-label">BIO</div>
        <div class="detail-value">{{ $serviceProvider->bio }}</div>

        <div class="detail-label">Work Location</div>
        <div class="detail-value">{{ $serviceProvider->location_work_governorate }}</div>

        <div class="detail-label">Category</div>
        <div class="detail-value">{{ $serviceProvider->category->title }}</div>

        <div class="detail-label">Description</div>
        <div class="detail-value">{{ $serviceProvider->description }}</div>

        <div class="detail-label">Profile</div>
        <div class="media-container">
            <img src="{{ asset('storage/' . $serviceProvider->profile) }}" alt="Profile Image">
        </div>

        <div class="detail-label">Cover</div>
        <div class="media-container">
            <img src="{{ asset('storage/' . $serviceProvider->cover) }}" alt="Cover Image">
        </div>

        @foreach ($serviceProvider->albums as $album)
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