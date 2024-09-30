@extends('layout.master')

@section('title', 'Show Event Request Category')

@section('css')
    <style>
        body {
            font-family: 'Nunito', sans-serif; /* A more modern font */
            background-color: #f9f9f9; /* A lighter shade for a fresher look */
            margin: 0;
            padding: 20px;
            color: #333; /* Dark grey for better readability */
        }

        .container {
            width: 60%; /* Adjusted for a better layout */
            margin: 40px auto; /* More space around the container */
            background: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Soft shadow for depth */
            padding: 20px;
            border-radius: 8px; /* Rounded corners */
        }

        .detail-label {
            font-weight: 600; /* Slightly bolder for emphasis */
            margin-bottom: 15px;
            color: #007bff; /* A touch of color */
        }

        .detail-value {
            margin-bottom: 30px;
            padding: 15px;
            border-radius: 8px;
            background-color: #f8f9fa; /* A very light background for contrast */
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.05); /* Inset shadow for depth */
        }

        #map {
            height: 400px;
            margin-bottom: 30px;
            border-radius: 8px; /* Consistency in design */
            overflow: hidden; /* Ensures no spillover */
        }

        .media-container img {
            width: 100%; /* Responsive images */
            border-radius: 8px; /* Consistent rounded corners */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Consistent shadow */
            object-fit: contain; /* Ensures the image is contained without being stretched or cut */
        }

        hr {
            border-color: #eee; /* Lighter color for the horizontal rule */
            margin-top: 40px;
        }
    </style>
@endsection

@section('content')

    <hr />
    <div class="container">
        <div class="detail-label">Title</div>
        <div class="detail-value">{{ $events_request_category->title }}</div>

        <div class="detail-label">Title AR</div>
        <div class="detail-value">{{ $events_request_category->title_ar }}</div>

        <div class="detail-label">ICON</div>
        <div class="media-container">
            <img src="{{ asset('storage/' . $events_request_category->icon) }}" alt="Service Category Icon" style="max-height: 200px;"> <!-- Responsive and bounded image height -->
        </div>

    </div>
@endsection
