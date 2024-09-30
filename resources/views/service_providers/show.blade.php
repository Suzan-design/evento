@extends('layout.master')

@section('title')
    Show Service Provider
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
    <hr />
    <div class="container">
        <div class="detail">User ID</div>
            <div class="detail-value"> 
        @if($serviceProvider->user)
            {{ $serviceProvider->user->first_name }} {{ $serviceProvider->user->last_name }}
        @endif
</div>

        <div class="detail">Name</div>
            <div class="detail-value"> {{ $serviceProvider->name }}</div>

        <div class="detail">Name AR</div>
            <div class="detail-value"> {{ $serviceProvider->name_ar }}</div>

        <div class="detail-label">Category</div>
            <div class="detail-value"> {{ $serviceProvider->category->title }}</div>

        <div class="detail-label">Work Location</div>
            <div class="detail-value">{{ $serviceProvider->location_work_governorate }}</div>

        <div class="detail-label">Description</div>
         <div class="detail-value"> {{ $serviceProvider->description }}</div>

        <div class="detail-label">description AR</div>
            <div class="detail-value"> {{ $serviceProvider->description_ar }}</div>

        <div class="detail-label">Profile</div>
            <div class="media-container">
                <img src="{{ asset('storage/' . $serviceProvider->profile) }}" alt="Service Category Icon" style="max-height: 200px;"> <!-- Responsive and bounded image height -->
            </div>

        <div class="detail-label">Cover</div>
            <div class="media-container">
                <img src="{{ asset('storage/' . $serviceProvider->cover) }}" alt="Service Category Icon" style="max-height: 200px;"> <!-- Responsive and bounded image height -->
            </div>
<hr/>
        @foreach ($serviceProvider->albums as $album)
            <div class="album-container">
                <div class="album-title">Album Name : {{ $album->name }}</div>

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
            <hr/>
        @endforeach
    </div>
@endsection
